<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/change_password_processor/page" method="post">
        <h1>Change 🔑</h1>
        <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="current_password">Current P/W: </label>
            <input id="current_password" name="current_password" type="password" value="" required minlength="1"
                   spellcheck="false">
        </p>
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

