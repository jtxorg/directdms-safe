<?php
/*
 * External document signing
 * This page handles signatures from external users via email requests
 */

session_start();

require_once('odm-load.php');
require_once('AccessLog_class.php');
require_once('File_class.php');
require_once('Reviewer_class.php');
require_once('Email_class.php');
require_once('include/PHPMailer/PHPMailer.php');
require_once('include/PHPMailer/SMTP.php');
require_once('include/PHPMailer/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Verify request key
if (!isset($_REQUEST['key']) || empty($_REQUEST['key'])) {
    header('Location: error.php?ec=13&last_message=' . urlencode('Invalid signature request'));
    exit;
}

$request_key = $_REQUEST['key'];

// Fetch signature request details
$query = "SELECT sr.*, d.realname as filename 
          FROM {$GLOBALS['CONFIG']['db_prefix']}signature_requests sr
          JOIN {$GLOBALS['CONFIG']['db_prefix']}data d ON sr.file_id = d.id
          WHERE (sr.request_key = ? OR sr.request_key LIKE ?) AND sr.status = 'pending'";
$stmt = $pdo->prepare($query);
$stmt->execute([$request_key, $request_key . '|%']);
$signature_request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$signature_request) {
    header('Location: error.php?ec=13&last_message=' . urlencode('Invalid or expired signature request'));
    exit;
}

$file_id = $signature_request['file_id'];
$file_obj = new FileData($file_id, $pdo);

// If password hasn't been verified yet
if (!isset($_SESSION['verified_signature_request']) || $_SESSION['verified_signature_request'] != $request_key) {
    // Display password entry form if not submitted yet
    if (!isset($_POST['password'])) {
        draw_header("Sign Document", '');
        $GLOBALS['smarty']->assign('request_key', $request_key);
        $GLOBALS['smarty']->assign('file_name', $file_obj->getName());
        $GLOBALS['smarty']->display('sign_document_password.tpl');
        draw_footer();
        exit;
    } else {
        // Get the password - either from password column or from request_key
        $stored_password = '';
        
        // First check if we have a dedicated password column
        if (isset($signature_request['password']) && !empty($signature_request['password'])) {
            $stored_password = $signature_request['password'];
        } else {
            // Extract password from request_key
            $parts = explode('|', $signature_request['request_key']);
            if (count($parts) > 1) {
                $stored_password = $parts[1];
            }
        }
        
        // Verify password
        if ($_POST['password'] === $stored_password) {
            $_SESSION['verified_signature_request'] = $request_key;
        } else {
            draw_header("Sign Document", 'Incorrect password. Please try again.');
            $GLOBALS['smarty']->assign('request_key', $request_key);
            $GLOBALS['smarty']->assign('file_name', $file_obj->getName());
            $GLOBALS['smarty']->display('sign_document_password.tpl');
            draw_footer();
            exit;
        }
    }
}

// Check if the file is a PDF
if ($file_obj->getType() !== 'application/pdf') {
    header('Location: error.php?ec=13&last_message=' . urlencode('File is not a PDF'));
    exit;
}

// Handle POST request (saving signatures)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf_file'])) {
    // 2a) Must have the PDF file
    if (!isset($_FILES['pdf_file'])) {
        header('Content-Type: application/json');
        echo json_encode([
          'success' => false,
          'message' => 'Missing required files or data'
        ]);
        exit;
    }

    // NOTE: CSRF validation has been removed for external document signing

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
        
        // Set the owner as the original requester
        $owner_id = $signature_request['requester_id'];
        
        $stmt->execute([
            $file_obj->getCategory(),                  // category
            $owner_id,                                 // owner
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
        // For external users, log with requester_id 
        $query = "INSERT INTO {$GLOBALS['CONFIG']['db_prefix']}access_log (file_id, user_id, timestamp, action) 
                  VALUES (:file_id, :uid, NOW(), :type)";
        $log_stmt = $pdo->prepare($query);
        $log_stmt->execute([
            ':file_id' => $newFileId,
            ':uid' => $signature_request['requester_id'],
            ':type' => 'A'
        ]);
        
        // Update the request status
        $lookupKey = $request_key;
        
        // Check if we need an exact match or LIKE query
        if (strpos($signature_request['request_key'], '|') !== false) {
            // The request_key contains password, so use LIKE
            $update = $pdo->prepare("
                UPDATE {$GLOBALS['CONFIG']['db_prefix']}signature_requests
                SET status = 'completed', 
                    completed_at = NOW(),
                    signed_file_id = ?
                WHERE request_key LIKE ?
            ");
            $update->execute([$newFileId, $lookupKey . '%']);
        } else {
            // Use exact match
            $update = $pdo->prepare("
                UPDATE {$GLOBALS['CONFIG']['db_prefix']}signature_requests
                SET status = 'completed', 
                    completed_at = NOW(),
                    signed_file_id = ?
                WHERE request_key = ?
            ");
            $update->execute([$newFileId, $lookupKey]);
        }
        
        // If notification is requested, send email to requester
        error_log("Notification check - notify_on_complete value: " . var_export($signature_request['notify_on_complete'], true));
        
        if (!empty($signature_request['notify_on_complete'])) {
            error_log("Notification requested for signature request ID: " . $signature_request['id']);
            
            // Get requester's email
            $stmt = $pdo->prepare("SELECT Email FROM {$GLOBALS['CONFIG']['db_prefix']}user WHERE id = ?");
            $stmt->execute([$signature_request['requester_id']]);
            $requester = $stmt->fetch();
            
            if ($requester && !empty($requester['Email'])) {
                // Send notification email
                try {
                    // Get SMTP settings from database
                    $query = "SELECT name, value FROM {$GLOBALS['CONFIG']['db_prefix']}settings WHERE name IN ('smtp_host', 'smtp_port', 'smtp_user', 'smtp_password')";
                    $smtp_stmt = $pdo->prepare($query);
                    $smtp_stmt->execute();
                    $smtp_settings = array();
                    while ($row = $smtp_stmt->fetch()) {
                        $smtp_settings[$row['name']] = $row['value'];
                    }
                    
                    // Log SMTP settings (without password)
                    error_log("SMTP Settings - Host: " . ($smtp_settings['smtp_host'] ?? 'not set') . 
                              ", Port: " . ($smtp_settings['smtp_port'] ?? 'not set') . 
                              ", Username: " . ($smtp_settings['smtp_user'] ?? 'not set'));
                    
                    // Check if we have all required SMTP settings
                    if (empty($smtp_settings['smtp_host']) || empty($smtp_settings['smtp_user'])) {
                        error_log("Missing SMTP settings for email notification");
                        // Continue without sending email
                    } else {
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->Host = $smtp_settings['smtp_host'];
                        $mail->SMTPAuth = true;
                        $mail->Username = $smtp_settings['smtp_user'];
                        $mail->Password = $smtp_settings['smtp_password'];
                        
                        // Try different ports
                        $ports = array(587, 465, 25);
                        $encryption = array(
                            587 => PHPMailer::ENCRYPTION_STARTTLS,
                            465 => PHPMailer::ENCRYPTION_SMTPS,
                            25 => PHPMailer::ENCRYPTION_STARTTLS
                        );
                        
                        $email_sent = false;
                        $last_error = '';
                        
                        foreach ($ports as $port) {
                            try {
                                if ($email_sent) break; // Skip if already sent
                                
                                $mail->Port = $port;
                                $mail->SMTPSecure = $encryption[$port];
                                
                                // Disable SSL verification for development
                                $mail->SMTPOptions = array(
                                    'ssl' => array(
                                        'verify_peer' => false,
                                        'verify_peer_name' => false,
                                        'allow_self_signed' => true
                                    )
                                );
                                
                                // Clear recipients before retrying
                                $mail->clearAddresses();
                                
                                $mail->setFrom($GLOBALS['CONFIG']['site_mail'], 'Avid Docuworks');
                                $mail->addAddress($requester['Email']);
                                
                                $mail->isHTML(true);
                                $mail->Subject = "Document has been signed: " . $file_obj->getName();
                                $mail->Body = "
                                    <p>Hello,</p>
                                    <p>The document you sent for signature has been signed.</p>
                                    <p>Document: " . $file_obj->getName() . "</p>
                                    <p>You can view the signed document here:</p>
                                    <p><a href='" . $GLOBALS['CONFIG']['base_url'] . "details.php?id={$newFileId}'>View Document</a></p>
                                    <p>Best regards,<br>Avid Docuworks</p>
                                ";
                                
                                if ($mail->send()) {
                                    $email_sent = true;
                                    error_log("Notification email sent successfully on port {$port}");
                                    break; // Success, exit the loop
                                }
                            } catch (Exception $e) {
                                $last_error = $e->getMessage();
                                error_log("Failed to send notification email on port {$port}. Error: {$last_error}");
                                continue; // Try next port
                            }
                        }
                        
                        if (!$email_sent) {
                            error_log("Failed to send notification email on all ports. Last error: {$last_error}");
                            // Try using PHP mail() as fallback
                            try {
                                error_log("Trying PHP mail() as fallback");
                                $to = $requester['Email'];
                                $subject = "Document has been signed: " . $file_obj->getName();
                                $message = "Hello,\n\n";
                                $message .= "The document you sent for signature has been signed.\n";
                                $message .= "Document: " . $file_obj->getName() . "\n\n";
                                $message .= "You can view the signed document here:\n";
                                $message .= $GLOBALS['CONFIG']['base_url'] . "details.php?id={$newFileId}\n\n";
                                $message .= "Best regards,\nAvid Docuworks";
                                
                                $headers = "From: " . $GLOBALS['CONFIG']['site_mail'] . "\r\n";
                                $headers .= "Reply-To: " . $GLOBALS['CONFIG']['site_mail'] . "\r\n";
                                
                                if (mail($to, $subject, $message, $headers)) {
                                    error_log("Notification email sent successfully using PHP mail()");
                                    $email_sent = true;
                                } else {
                                    error_log("Failed to send notification email using PHP mail()");
                                }
                            } catch (Exception $e) {
                                error_log("Error using PHP mail(): " . $e->getMessage());
                            }
                        }
                    }
                } catch (Exception $e) {
                    error_log("Failed to send notification email: " . $e->getMessage());
                    // Don't throw exception here as signing was successful
                }
            } else {
                error_log("Could not find email for requester ID: " . $signature_request['requester_id']);
            }
        }
        
        // Clear the verification session
        unset($_SESSION['verified_signature_request']);

        // 2i) Return JSON success
        header('Content-Type: application/json');
        echo json_encode([
          'success'      => true,
          'redirect_url' => "thank_you.php?message=" . urlencode('Document signed successfully') . 
                            "&signed_file_id={$newFileId}&key=" . urlencode($request_key)
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
    $GLOBALS['smarty']->assign('request_key', $request_key);
    $GLOBALS['smarty']->assign(
      'csrfp_token',
      $_COOKIE['csrfp_token'] ?? ''
    );
    
    // Use the same signature editor UI as self-sign
    $GLOBALS['smarty']->display('sign_document_external.tpl');

    draw_footer();
} 
