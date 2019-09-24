<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/UploadProcessor/page" method="post" enctype="multipart/form-data">
    <h1>Upload an 🖼️</h1>
    <h2>Choose the file from your 🖥️</h2>
    <p class="tooltip">ℹ️
        <span class="tooltiptext tooltip-top">Only .jpg, .jpeg, .png, .gif files can be uploaded.</span>
    </p>
    <p>* Only .jpg, .jpeg, .png, .gif files can be uploaded.</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <input id="fileToUpload" name="fileToUpload" type="file">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>