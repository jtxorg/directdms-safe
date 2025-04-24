{* Smarty template for document signing *}

<style type="text/css">
{literal}
.sign-container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
}

.sign-options {
    display: flex;
    gap: 20px;
    margin-top: 20px;
}

.sign-option {
    flex: 1;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.button {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.button:hover {
    background-color: #0056b3;
}
{/literal}
</style>

<div class="sign-container">
    <h2>Sign Document: {$file_name}</h2>
    
    <div class="sign-options">
        <div class="sign-option">
            <h3>Self Sign</h3>
            <p>Click the button below to sign this document yourself. The original document will remain unchanged, and a new signed copy will be created.</p>
            <form method="post" action="sign.php?id={$smarty.get.id}">
                <input type="submit" name="self_sign" value="Self Sign Only" class="button">
            </form>
        </div>
        
        <div class="sign-option">
            <h3>Send for Signature</h3>
            <p>Enter an email address below to send this document for someone else to sign. They will receive an email with a secure link to view and sign the document.</p>
            <form method="post" action="sign.php?id={$smarty.get.id}">
                <div class="form-group">
                    <label for="email">Recipient's Email:</label>
                    <input type="email" name="email" id="email" required class="form-control">
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="notify" value="1">
                        Notify me when signature is applied
                    </label>
                </div>
                <input type="submit" name="send_for_signature" value="Send for Signature" class="button">
            </form>
        </div>
    </div>
</div> 