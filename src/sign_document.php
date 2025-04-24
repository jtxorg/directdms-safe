<?php

session_start();

require_once('odm-load.php');
require_once('AccessLog_class.php');
require_once('File_class.php');
require_once('Reviewer_class.php');
require_once('Email_class.php');

if (!isset($_SESSION['uid'])) {
    redirect_visitor();
}

$user_obj = new User($_SESSION['uid'], $pdo);
$file_id = (int)$_REQUEST['id'];
$file_obj = new FileData($file_id, $pdo);

// Check permission
if ($file_obj->getType() !== 'application/pdf') {
    header('Location: error.php?ec=13&last_message=' . urlencode('File is not a PDF'));
    exit;
}

// Handle POST request (saving signatures)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 2a) Must have the PDF and CSRF
    if (
        !isset($_FILES['pdf_file']) ||
        !isset($_POST['csrfp_token'])
    ) {
        header('Content-Type: application/json');
        echo json_encode([
          'success' => false,
          'message' => 'Missing required files or data'
        ]);
        exit;
    }

    // 2b) CSRF
    if ($_POST['csrfp_token'] !== ($_COOKIE['csrfp_token'] ?? '')) {
        header('Content-Type: application/json');
        echo json_encode([
          'success' => false,
          'message' => 'Invalid CSRF token'
        ]);
        exit;
    }

    try {
        // 2c) Upload error check
        switch ($_FILES['pdf_file']['error']) {
            case UPLOAD_ERR_OK: break;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new Exception('Uploaded file is too large');
            case UPLOAD_ERR_PARTIAL:
                throw new Exception('File only partially uploaded');
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file was uploaded');
            default:
                throw new Exception('File upload error code ' . $_FILES['pdf_file']['error']);
        }

        // 2d) MIME check
        $finfo     = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['pdf_file']['tmp_name']);
        finfo_close($finfo);
        if ($mime_type !== 'application/pdf') {
            throw new Exception("Invalid file type: {$mime_type}");
        }

        // 2e) Move into your data directory
        $timestamp = date('Y-m-d_H-i-s');
        $baseName = pathinfo($file_obj->getName(), PATHINFO_FILENAME);
        $newFilename = "{$baseName}_signed_{$timestamp}.pdf";
        
        // First insert into database to get the new file ID
        $stmt = $pdo->prepare("
            INSERT INTO {$GLOBALS['CONFIG']['db_prefix']}data
              (category, owner, realname, created, description, 
               comment, status, department, default_rights, publishable)
            VALUES
              (?, ?, ?, NOW(), ?,
               ?, 1, ?, 0, 1)
        ");
        $stmt->execute([
            $file_obj->getCategory(),                  // category
            $_SESSION['uid'],                          // owner
            $newFilename,                              // realname
            'Signed version of ' . $file_obj->getName(), // description
            'Document signed on ' . date('Y-m-d H:i:s'), // comment
            $file_obj->getDepartment()                 // department
        ]);
        $newFileId = $pdo->lastInsertId();
        
        // Now save the file with the ID as filename
        $signedFilePath = rtrim($GLOBALS['CONFIG']['dataDir'], '/') . '/' . $newFileId . '.dat';
        
        if (!move_uploaded_file(
            $_FILES['pdf_file']['tmp_name'],
            $signedFilePath
        )) {
            // If file move fails, rollback the database insert
            $pdo->prepare("DELETE FROM {$GLOBALS['CONFIG']['db_prefix']}data WHERE id = ?")->execute([$newFileId]);
            throw new Exception('Failed to save PDF to disk');
        }

        // 2g) Copy permissions
        foreach (['user_perms' => 'uid', 'dept_perms' => 'dept_id'] as $tbl => $col) {
            $copy = $pdo->prepare("
                INSERT INTO {$GLOBALS['CONFIG']['db_prefix']}{$tbl}
                  (fid, {$col}, rights)
                SELECT ?, {$col}, rights
                  FROM {$GLOBALS['CONFIG']['db_prefix']}{$tbl}
                 WHERE fid = ?
            ");
            $copy->execute([$newFileId, $file_id]);
        }

        // 2h) Log the action
        $accessLog = new AccessLog($pdo);
        $accessLog::addLogEntry(
          $newFileId,
          'A',
          $pdo
        );

        // 2i) Return JSON success
        header('Content-Type: application/json');
        echo json_encode([
          'success'      => true,
          'redirect_url' => "details.php?id={$newFileId}"
                          . "&last_message="
                          . urlencode('Document signed successfully')
        ]);
        exit;

    } catch (Exception $e) {
        error_log('Error processing signed document: ' . $e->getMessage());
        error_log($e->getTraceAsString());
        header('Content-Type: application/json');
        echo json_encode([
          'success' => false,
          'message' => 'Error processing signed document: ' . $e->getMessage()
        ]);
        exit;
    }

} else {
    // —————————————————————————————————————————————————————————————
    // GET → Show the signing UI
    // —————————————————————————————————————————————————————————————
    draw_header("Sign Document", '');

    $GLOBALS['smarty']->assign('file_id',     $file_id);
    $GLOBALS['smarty']->assign('file_name',   $file_obj->getName());
    $GLOBALS['smarty']->assign(
      'csrfp_token',
      $_COOKIE['csrfp_token'] ?? ''
    );
    $GLOBALS['smarty']->display('sign_document.tpl');

    draw_footer();
}