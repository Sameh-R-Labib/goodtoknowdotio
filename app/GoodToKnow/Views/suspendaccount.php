<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/SuspendAccountProcessor/page" method="post">
    <h1>Suspend Account</h1>
    <h2>Enter the Username</h2>
    <?php require SESSIONMESSAGE; ?>
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