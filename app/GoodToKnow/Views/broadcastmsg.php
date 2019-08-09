<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/BroadcastMsgProcessor/page" method="post">
    <h2><a href="https://michelf.ca/projects/php-markdown/extra/" target="_blank">📒 Markdown</a></h2>
    <?php require SESSIONMESSAGE; ?>
    <p>
        <small>🚩: ✅ markdown ✅ emoji ⚖️ max. 1500 bytes.<br>
            🔏: ✅ GPG encrypt message w/ receiving user's pub key.
        </small>
    </p>
    <?php require URLOFMOSTRECENTUPLOAD; ?>
    <section>
        <p>
            <label for="textarea"></label>
            <textarea id="textarea" spellcheck="false" name="markdown" rows="27" cols="71"
                      wrap="soft"><?= $pre_populate ?></textarea>
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>