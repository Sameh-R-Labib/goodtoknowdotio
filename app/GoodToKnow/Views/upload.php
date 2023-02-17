<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/upload_processor/page" method="post" enctype="multipart/form-data">
        <h1>Upload an 🖼️</h1>
        <p class="tooltip">ⅈ
            <span class="tooltiptext tooltip-top">Only .jpg, .jpeg, .png, .gif files can be uploaded.<br><br>
        Please do Not upload an image if you are not going to insert that image in your post immediately.
        Basically, the upload process will yield a URL for the uploaded image.</span>
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