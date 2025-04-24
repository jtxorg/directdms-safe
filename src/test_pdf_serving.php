<?php
/*
 * Test PDF serving
 * This file helps diagnose issues with PDF viewing
 */

session_start();
require_once('odm-load.php');

// Require authentication
if (!isset($_SESSION['uid'])) {
    header('Location: index.php?redirection=' . urlencode($_SERVER['PHP_SELF']));
    exit;
}

// Get file ID
$file_id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if (!$file_id) {
    die('Missing file ID');
}

$file_obj = new FileData($file_id, $pdo);

// Check permission
checkUserPermission($file_id, $file_obj->READ_RIGHT, $file_obj);

// Make sure it's a PDF
if ($file_obj->getType() !== 'application/pdf') {
    die('Not a PDF file');
}

// Get file path
$filename = $GLOBALS['CONFIG']['dataDir'] . $file_id . ".dat";

if (!file_exists($filename)) {
    die('File does not exist on disk');
}

// Display test page
?>
<!DOCTYPE html>
<html>
<head>
    <title>PDF Test Page</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .test-section { margin-bottom: 30px; border: 1px solid #ccc; padding: 15px; }
        h2 { margin-top: 0; }
        iframe { width: 100%; height: 500px; border: 1px solid #ccc; }
    </style>
</head>
<body>
    <div class="container">
        <h1>PDF Serving Test</h1>
        
        <div class="test-section">
            <h2>File Info</h2>
            <ul>
                <li><strong>File ID:</strong> <?= $file_id ?></li>
                <li><strong>Name:</strong> <?= htmlspecialchars($file_obj->getName()) ?></li>
                <li><strong>MIME Type:</strong> <?= $file_obj->getType() ?></li>
                <li><strong>File Size:</strong> <?= $file_obj->getFileSize() ?> bytes</li>
                <li><strong>File Path:</strong> <?= htmlspecialchars($filename) ?></li>
            </ul>
        </div>
        
        <div class="test-section">
            <h2>Embedding Test - view_file.php</h2>
            <iframe src="view_file.php?submit=view&id=<?= $file_id ?>&mimetype=application/pdf"></iframe>
        </div>
        
        <div class="test-section">
            <h2>First 100 Bytes (Hex)</h2>
            <pre><?php
                $f = fopen($filename, 'rb');
                $data = fread($f, 100);
                fclose($f);
                echo bin2hex($data);
            ?></pre>
        </div>
        
        <div class="test-section">
            <h2>Check PDF Signature</h2>
            <?php
                $f = fopen($filename, 'rb');
                $header = fread($f, 5);
                fclose($f);
                $isPdf = substr($header, 0, 4) === '%PDF';
                echo $isPdf ? 
                    '<p style="color: green">Valid PDF signature found</p>' : 
                    '<p style="color: red">Invalid PDF signature - not starting with %PDF</p>';
            ?>
        </div>
        
        <div class="test-section">
            <h2>Simple Direct Serving</h2>
            <a href="test_pdf_viewer.php?id=<?= $file_id ?>" target="_blank">Click to open PDF directly</a>
        </div>
    </div>
</body>
</html><?php
// End of file
?> 