{* Sign Document Template with Direct PDF Embedding *}
<style>
{literal}
.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    padding: 20px;
}

.pdf-container {
    width: 100%;
    height: 800px;
    border: 1px solid #ccc;
    border-radius: 4px;
    overflow: hidden;
}

.pdf-embed {
    width: 100%;
    height: 100%;
    border: none;
}

.buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
}

.btn {
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    background: #007bff;
    color: white;
    cursor: pointer;
    font-size: 16px;
    text-decoration: none;
    transition: background 0.2s;
}

.btn:hover {
    background: #0056b3;
}

.btn-primary {
    background: #28a745;
}

.btn-primary:hover {
    background: #218838;
}
{/literal}
</style>

<div class="container">
    <h2>Sign Document: {$file_name}</h2>
    
    <div class="pdf-container">
        <iframe class="pdf-embed" src="{$pdf_url}" allowfullscreen></iframe>
    </div>
    
    <div class="buttons">
        <a class="btn" href="{if $is_external}sign_document.php?key={$request_key}{else}details.php?id={$file_id}{/if}">Cancel</a>
        <a class="btn btn-primary" href="sign_document.php?{if $is_external}key={$request_key}{else}id={$file_id}{/if}&mode=app">Use Signature App</a>
    </div>
    
    <p>
        <strong>Note:</strong> If you're having trouble viewing the PDF above, 
        you can <a href="{$pdf_url}" target="_blank">download it here</a> 
        and then use the Signature App option to sign it.
    </p>
</div> 