<?php
session_start();
require_once('odm-load.php');

$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'Thank you for signing the document.';
$signed_file_id = isset($_GET['signed_file_id']) ? (int)$_GET['signed_file_id'] : null;
$request_key = isset($_GET['key']) ? $_GET['key'] : null;

draw_header("Thank You", '');

// If we have a signed file ID, get information about it
$file_info = null;
if ($signed_file_id) {
    try {
        $stmt = $pdo->prepare("SELECT realname FROM {$GLOBALS['CONFIG']['db_prefix']}data WHERE id = ?");
        $stmt->execute([$signed_file_id]);
        $file_info = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log("Error retrieving signed file info: " . $e->getMessage());
    }
}

// Determine if this is an authenticated user or external user
$is_external = !isset($_SESSION['uid']) && $request_key;
?>

<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      <h2>Thank You</h2>
    </div>
    <div class="card-body">
      <div class="alert alert-success">
        <p><?php echo $message; ?></p>
      </div>
      <p>The document has been successfully signed and saved.</p>
      
      <?php if ($file_info && $signed_file_id): ?>
      <div class="mt-4">
        <p>Document: <strong><?php echo htmlspecialchars($file_info['realname']); ?></strong></p>
        <p>
          <?php if ($is_external && $request_key): ?>
          <a href="download_signed.php?id=<?php echo $signed_file_id; ?>&key=<?php echo urlencode($request_key); ?>" class="btn btn-primary">
            Download Signed Document
          </a>
          <?php else: ?>
          <a href="view_file.php?submit=Download&id=<?php echo $signed_file_id; ?>&mimetype=application/pdf" class="btn btn-primary">
            Download Signed Document
          </a>
          <?php endif; ?>
        </p>
      </div>
      <?php endif; ?>
      
      <p class="mt-3">You may now close this window.</p>
    </div>
  </div>
</div>

<?php
draw_footer();
?> 