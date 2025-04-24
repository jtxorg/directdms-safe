<?php
/*
 * PDF Debug Tool
 * For diagnosing issues with PDF files
 */

session_start();
require_once('odm-load.php');

// Check authentication - only admin users can access
if (!isset($_SESSION['uid'])) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied: Authentication required';
    exit;
}

// Check if user is admin
$user_obj = new User($_SESSION['uid'], $pdo);
if (!$user_obj->isAdmin()) {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access denied: Admin privileges required';
    exit;
}

draw_header("PDF Debug Tool", '');

// Process file ID if provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $file_id = (int)$_GET['id'];
    $file_obj = new FileData($file_id, $pdo);
    
    // Check if file exists
    if (!$file_obj->getFileSize()) {
        echo "<div class='alert alert-danger'>File ID {$file_id} not found.</div>";
    } else {
        echo "<h2>File Details</h2>";
        echo "<table class='table table-striped'>";
        echo "<tr><th>File ID</th><td>{$file_id}</td></tr>";
        echo "<tr><th>Name</th><td>{$file_obj->getName()}</td></tr>";
        echo "<tr><th>Size</th><td>{$file_obj->getFileSize()} bytes</td></tr>";
        echo "<tr><th>MIME Type</th><td>{$file_obj->getType()}</td></tr>";
        
        // Get file path
        $filepath = '';
        if ($file_obj->isArchived()) {
            $filepath = $GLOBALS['CONFIG']['archiveDir'] . $file_id . ".dat";
        } else {
            $filepath = $GLOBALS['CONFIG']['dataDir'] . $file_id . ".dat";
        }
        
        echo "<tr><th>File Path</th><td>{$filepath}</td></tr>";
        echo "<tr><th>File Exists</th><td>" . (file_exists($filepath) ? 'Yes' : 'No') . "</td></tr>";
        
        // Check PDF signature
        if (file_exists($filepath)) {
            $handle = fopen($filepath, 'rb');
            $header = fread($handle, 5);
            fclose($handle);
            $isPDF = (substr($header, 0, 4) === '%PDF');
            
            echo "<tr><th>PDF Signature</th><td>" . ($isPDF ? 'Valid (%PDF found)' : 'Invalid (No %PDF header)') . "</td></tr>";
            
            // Show first 100 bytes
            $handle = fopen($filepath, 'rb');
            $firstBytes = fread($handle, 100);
            fclose($handle);
            
            echo "<tr><th>First 100 bytes (hex)</th><td><code>" . bin2hex($firstBytes) . "</code></td></tr>";
            echo "<tr><th>First 100 bytes (raw)</th><td><pre>" . htmlspecialchars($firstBytes) . "</pre></td></tr>";
        }
        
        echo "</table>";
        
        // Action buttons
        echo "<div class='mt-4'>";
        echo "<a href='view_file.php?submit=view&id={$file_id}&mimetype=application/pdf' class='btn btn-primary mx-2' target='_blank'>View with view_file.php</a>";
        echo "<a href='view_signature_file.php?key=debug&id={$file_id}' class='btn btn-info mx-2' target='_blank'>View with view_signature_file.php</a>";
        echo "</div>";
    }
}

// Show form to enter file ID
echo "<div class='card mt-4'>";
echo "<div class='card-header'><h3>Debug a PDF File</h3></div>";
echo "<div class='card-body'>";
echo "<form method='get' action='debug_pdf.php'>";
echo "<div class='form-group'>";
echo "<label for='id'>Enter File ID:</label>";
echo "<input type='number' name='id' id='id' class='form-control' required>";
echo "</div>";
echo "<button type='submit' class='btn btn-primary mt-3'>Debug File</button>";
echo "</form>";
echo "</div>";
echo "</div>";

draw_footer();
?> 