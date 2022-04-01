<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/member_memo_editor_processor/page" method="post">
        <h1>Member's 📝 Editor</h1>
        <?php require SESSIONMESSAGE; ?>
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