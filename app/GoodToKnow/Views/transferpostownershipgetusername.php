<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/TransferPostOwnershipTransferIt/page" method="post">
    <h2>Enter the Username of New Owner</h2>
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