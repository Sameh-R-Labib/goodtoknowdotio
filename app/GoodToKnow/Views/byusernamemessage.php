<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/ByUsernameMessageProcessor/page" method="post">
    <h1>Username 💬 a User</h1>
    <h2>Enter the Username</h2>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="username">U/N: </label>
            <input id="username" name="username" type="text" required minlength="7" maxlength="12" size="12"
                   spellcheck="false">
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