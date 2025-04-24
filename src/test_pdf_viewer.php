<?php
/*
 * Simple direct PDF viewer
 * For testing purposes
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

// Log the access
AccessLog::addLogEntry($file_id, 'V', $pdo);

// Clean all output buffers
while (ob_get_level()) {
    ob_end_clean();
}

// Send PDF directly to browser
header('Content-Type: application/pdf');
header('Content-Length: ' . filesize($filename));
header('Accept-Ranges: bytes');
header('Content-Disposition: inline; filename="' . basename($file_obj->getName()) . '"');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Read file in binary mode and send it directly to output
readfile($filename);
exit;
?> 