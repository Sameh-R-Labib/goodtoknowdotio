<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/ByUsernameMessageSave/page" method="post">
        <h1>Message Editor</h1>
        <h2><a href="https://michelf.ca/projects/php-markdown/extra/" target="_blank">📒 Markdown</a></h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">✅ markdown ✅ emoji ⚖️ max. 1500 bytes.
            ✅ GPG encrypt message w/ receiving user's pub key.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <?php require URLOFMOSTRECENTUPLOAD; ?>
        <section>
            <p>
                <label for="textarea"></label>
                <textarea id="textarea" spellcheck="false" name="markdown" rows="26" cols="71"
                          wrap="soft"><?= $pre_populate ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>