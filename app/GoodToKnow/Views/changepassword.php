<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/ChangePasswordProcessor/page" method="post">
    <h2>Change Password</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>⚠️ all fields required.</p>
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
            <label for="new_password">Reenter it: </label>
            <input id="new_password" name="new_password" type="password" value="" required minlength="1"
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