<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/MessageTheAuthorProcessor/page" method="post">
    <h2><a href="https://michelf.ca/projects/php-markdown/extra/" target="_blank">📒 Markdown</a>
        <a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet" target="_blank">📄 Cheatsheet</a>
    </h2>
    <p class="tooltip">ℹ️
        <span class="tooltiptext tooltip-top">✅ markdown ✅ emoji 📲️ maximum 1500 bytes.</span>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <?php require URLOFMOSTRECENTUPLOAD; ?>
    <section>
        <p>
            <label for="textarea"></label>
            <textarea id="textarea" spellcheck="false" name="markdown" rows="21" cols="87"
                      wrap="soft"><?= $pre_populate ?></textarea>
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>