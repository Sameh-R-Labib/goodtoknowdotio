<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/message_the_author_processor/page" method="post">
        <p><a href="https://michelf.ca/projects/php-markdown/extra/" target="_blank">📒 Markdown</a>
            <a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet" target="_blank">📄 Cheatsheet</a>
        </p>
        <table>
            <tr>
                <td><p class="tooltip">ⅈ
                        <span class="tooltiptext tooltip-top">✅ markdown ✅ emoji 📲️ 1500 bytes.</span>
                    </p></td>
                <td><?php require URLOFMOSTRECENTUPLOAD; ?></td>
            </tr>
        </table>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="textarea"></label>
                <textarea id="textarea" spellcheck="false" name="markdown" rows="32" cols="67"
                          wrap="soft"><?= $g->pre_populate ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>