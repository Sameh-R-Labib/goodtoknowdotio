<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/UploadProcessor/page" method="post" enctype="multipart/form-data">
    <h2>Upload an image file</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>* Only .jpg, .jpeg, .png, .gif files can be uploaded.</p>
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