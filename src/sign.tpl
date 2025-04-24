{* sign.tpl - Template for document signing page *}

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3>Send Document for Signature</h3>
                </div>
                <div class="card-body">
                    <p>You are about to send <strong>{$file_name}</strong> for signature.</p>
                    
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="email">Recipient's Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message (optional):</label>
                            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" name="submit" class="btn btn-primary">Send for Signature</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 