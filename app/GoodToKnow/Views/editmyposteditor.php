<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/edit_my_post_edit_processor/page" method="post">
        <p><a href="https://michelf.ca/projects/php-markdown/extra/" target="_blank">📒 Markdown</a>
            <a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet" target="_blank">📄 Cheatsheet</a>
        </p>
        <table>
            <tr>
                <td><p class="tooltip">ⅈ
                        <span class="tooltiptext tooltip-top">Limit the scope to context and have it be opinionated.
            For example if the community is about Jabber chat then create posts which
            describe the way we all set up our chat clients.</span>
                    </p></td>
                <td><?php require URLOFMOSTRECENTUPLOAD; ?></td>
            </tr>
        </table>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="textarea"></label>
                <textarea id="textarea" spellcheck="false" name="markdown" rows="32"
                          cols="67" wrap="soft"><?= $g->markdown ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>