<?php
/*
 * Secure download for externally signed documents
 * Allows downloading the signed file with a valid signature request key
 */

session_start();
include('odm-load.php');
require_once("AccessLog_class.php");

// Verify the request key and signed file ID
if (
    !isset($_GET['key']) || empty($_GET['key']) || 
    !isset($_GET['id']) || !is_numeric($_GET['id'])
) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied: Missing required parameters';
    exit;
}

$request_key = $_GET['key'];
$signed_file_id = (int)$_GET['id'];

// Fetch signature request details
$query = "SELECT sr.* 
          FROM {$GLOBALS['CONFIG']['db_prefix']}signature_requests sr
          WHERE (sr.request_key = ? OR sr.request_key LIKE ?) 
          AND sr.status = 'completed'
          AND sr.signed_file_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$request_key, $request_key . '|%', $signed_file_id]);
$signature_request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$signature_request) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied: Invalid or expired signature request';
    exit;
}

// Get signed file info
$file_obj = new FileData($signed_file_id, $pdo);
$realname = $file_obj->getName();

// Security check: Only PDF files can be downloaded
if ($file_obj->getType() !== 'application/pdf') {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied: Only PDF files can be downloaded';
    exit;
}

// Get file path
$filename = $GLOBALS['CONFIG']['dataDir'] . $signed_file_id . ".dat";

if (!file_exists($filename)) {
    header('HTTP/1.0 404 Not Found');
    echo 'File not found: The requested document does not exist';
    exit;
}

// Clean all output buffers
while (ob_get_level()) {
    ob_end_clean();
}

// Log the download - use requester_id
if ($signature_request['requester_id']) {
    $query = "INSERT INTO {$GLOBALS['CONFIG']['db_prefix']}access_log (file_id, user_id, timestamp, action) 
              VALUES (:file_id, :uid, NOW(), :type)";
    $log_stmt = $pdo->prepare($query);
    $log_stmt->execute([
        ':file_id' => $signed_file_id,
        ':uid' => $signature_request['requester_id'],
        ':type' => 'D'
    ]);
}

// Send file as download
header('Content-Type: application/pdf');
header('Content-Length: ' . filesize($filename));
header('Content-Disposition: attachment; filename="' . basename($realname) . '"');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Output the file
readfile($filename);
exit; 