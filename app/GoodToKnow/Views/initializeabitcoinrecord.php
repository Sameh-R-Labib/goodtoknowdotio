<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/InitializeABitcoinRecordProcessor/page" method="post">
    <h1>Create a ₿ 📽</h1>
    <h2>Initialize the record with its bitcoin address</h2>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="address">₿ address: </label>
            <input id="address" name="address" type="text" value="" required minlength="8" maxlength="264"
                   size="67" spellcheck="false">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>