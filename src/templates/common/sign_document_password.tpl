<div class="row">
  <div class="col-md-6 offset-md-3">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Secure Document Signing</h5>
      </div>
      <div class="card-body">
        <p>You've been requested to sign the document: <strong>{$file_name}</strong></p>
        <p>Please enter the password that was provided in the email to continue.</p>
        
        <form method="post" action="sign_document_external.php?key={$request_key}">
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-primary">Continue to Sign</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> 