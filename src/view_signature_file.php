<?php
/*
 * View file for external signature requests
 * This script allows viewing PDF files for signing without authentication
 * but requires a valid signature request key
 */

// At the start of the file - override any potential CSRF validation
// CSRF protection is disabled for this file
// This needs to be before loading any other code
$_COOKIE['csrfp_token'] = $_POST['csrfp_token'] = isset($_SERVER['HTTP_X_CSRF_TOKEN']) ? $_SERVER['HTTP_X_CSRF_TOKEN'] : 'disabled_for_signing';

// No output before session start
session_start();
include('odm-load.php');
require_once("AccessLog_class.php");

// Security: Only allow PDF files to be displayed through this script
$allowed_mime_types = ['application/pdf'];

// Verify the request key
if (!isset($_GET['key']) || empty($_GET['key'])) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied: Missing request key';
    exit;
}

$request_key = $_GET['key'];

// Special debug case
if ($request_key === 'debug' && isset($_GET['id']) && is_numeric($_GET['id'])) {
    // For debugging, use direct file ID
    $file_id = (int)$_GET['id'];
    if (isset($_SESSION['uid'])) {
        $file_obj = new FileData($file_id, $pdo);
        
        // Check permission
        checkUserPermission($file_id, $file_obj->READ_RIGHT, $file_obj);
        
        // Skip request verification
        goto serve_file;
    }
}

// Fetch signature request details
$query = "SELECT sr.*, d.realname as filename 
          FROM {$GLOBALS['CONFIG']['db_prefix']}signature_requests sr
          JOIN {$GLOBALS['CONFIG']['db_prefix']}data d ON sr.file_id = d.id
          WHERE (sr.request_key = ? OR sr.request_key LIKE ?) AND sr.status = 'pending'";
$stmt = $pdo->prepare($query);
$stmt->execute([$request_key, $request_key . '|%']);
$signature_request = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$signature_request) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied: Invalid or expired signature request';
    exit;
}

// Check if the user has validated the password for this request
if (!isset($_SESSION['verified_signature_request']) || $_SESSION['verified_signature_request'] != $request_key) {
    header('Location: sign_document_external.php?key=' . $request_key);
    exit;
}

$file_id = $signature_request['file_id'];
$file_obj = new FileData($file_id, $pdo);
$realname = $file_obj->getName();

// Security check: Only PDF files can be viewed
if ($file_obj->getType() !== 'application/pdf') {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied: Only PDF files can be viewed for signing';
    exit;
}

serve_file:
// Get the file path
$filename = $GLOBALS['CONFIG']['dataDir'] . $file_id . ".dat";

// Debug mode - set to true to check file issues 
$debug = isset($_GET['debug']) && $_GET['debug'] === '1';

if (file_exists($filename)) {
    // For debugging
    if ($debug) {
        $fileSize = filesize($filename);
        $fileData = file_get_contents($filename, false, null, 0, min(1000, $fileSize));
        header('Content-Type: text/plain');
        echo "File exists: Yes\n";
        echo "File size: $fileSize bytes\n";
        echo "File path: $filename\n";
        echo "MIME type from FileData: " . $file_obj->getType() . "\n";
        echo "First 100 bytes (hex): " . bin2hex(substr($fileData, 0, 100)) . "\n";
        echo "First 100 bytes (raw): " . substr($fileData, 0, 100) . "\n";
        echo "PDF Signature check: " . (substr($fileData, 0, 4) === '%PDF' ? 'Valid PDF signature' : 'Invalid PDF signature');
        exit;
    }
    
    // Clean all output buffers
    while (ob_get_level()) {
        ob_end_clean();
    }

    // Log the access - only if user is logged in
    if (isset($_SESSION['uid'])) {
        AccessLog::addLogEntry($file_id, 'V', $pdo);
    } else {
        // For external users, log with requester_id if available
        if (isset($signature_request['requester_id'])) {
            // Direct query instead of using AccessLog class to avoid session dependency
            $query = "INSERT INTO {$GLOBALS['CONFIG']['db_prefix']}access_log (file_id, user_id, timestamp, action) 
                      VALUES (:file_id, :uid, NOW(), :type)";
            $log_stmt = $pdo->prepare($query);
            $log_stmt->execute([
                ':file_id' => $file_id,
                ':uid' => $signature_request['requester_id'],
                ':type' => 'V'
            ]);
        }
    }
    
    // Set headers for proper PDF viewing
    header('Content-Type: application/pdf');
    header('Content-Length: ' . filesize($filename));
    header('Accept-Ranges: bytes');
    header('Content-Disposition: inline; filename="document.pdf"');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Disable any compression
    ini_set('zlib.output_compression', '0');
    
    // Read the file directly and output it in chunks
    $handle = fopen($filename, 'rb');
    if ($handle) {
        // Read in 1MB chunks for better performance with large files
        $buffer = '';
        while (!feof($handle)) {
            $buffer = fread($handle, 1024 * 1024);
            echo $buffer;
            ob_flush();
            flush();
        }
        fclose($handle);
    }
    exit;
} else {
    header('HTTP/1.0 404 Not Found');
    echo 'File not found: The requested document does not exist';
    exit;
} 