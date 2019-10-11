<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/UploadProcessor/page" method="post" enctype="multipart/form-data">
        <h1>Upload an 🖼️</h1>
        <h2>Choose the file from your 🖥️</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">Only .jpg, .jpeg, .png, .gif files can be uploaded.<br><br>
        Please do Not upload an image if you are not able/willing to insert that image in your post immediately.
        Basically, the upload process will yield a URL which you can use within image placement markdown
            or as a hyperlink markdown to the image. Review markdown syntax first. A link to the markdown
        documentation is in the editor.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <input id="fileToUpload" name="fileToUpload" type="file">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>