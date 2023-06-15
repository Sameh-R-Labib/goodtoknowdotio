<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/reset_a_passphrase_submitted_passphrase/page" method="post">
    <h1><?= $g->html_title ?></h1>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="first_try">New P/W: </label>
            <input id="first_try" name="first_try" type="password" value="" required minlength="1" spellcheck="false">
        </p>
        <p>
            <label for="password">Reenter it: </label>
            <input id="password" name="password" type="password" value="" required minlength="1"
                   spellcheck="false">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
