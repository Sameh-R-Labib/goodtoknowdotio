<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/UploadProcessor/page" method="post" enctype="multipart/form-data">
    <h1>Upload an 🖼️</h1>
    <h2>Choose the file from your 🖥️</h2>
    <p>* Only .jpg, .jpeg, .png, .gif files can be uploaded.</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <input id="fileToUpload" name="fileToUpload" type="file">
        </p>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>