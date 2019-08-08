<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/EditMyPostEditProcessor/page" method="post">
    <h2><a href="https://michelf.ca/projects/php-markdown/extra/" target="_blank">📒 Markdown</a></h2>
    <?php require SESSIONMESSAGE; ?>
    <p>
        <small>📌: Limit the scope to the context and have it be opinionated.
            For example if the community is about Jabber chat then create posts which
            describe the way we all set up our chat clients.
        </small>
    </p>
    <?php require URLOFMOSTRECENTUPLOAD; ?>
    <section>
        <p>
            <label for="textarea"></label>
            <textarea id="textarea" spellcheck="false" name="markdown" rows="29"
                      cols="71" wrap="soft"><?= $markdown ?></textarea>
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