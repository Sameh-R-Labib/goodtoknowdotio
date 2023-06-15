<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/reset_a_passphrase_identify_user/page" method="post">
    <h1><?= $g->html_title ?></h1>
    <?php require SESSIONMESSAGE; ?>
    <p class="tooltip">ⅈ
        <span class="tooltiptext tooltip-top">Most likely you're doing this because user forgot passphrase.</span>
    </p>
    <p>Enter the Username</p>
    <section>
        <p>
            <label for="username">U/N: </label>
            <input id="username" name="username" type="text" required minlength="7" maxlength="12" size="12"
                   spellcheck="false">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
