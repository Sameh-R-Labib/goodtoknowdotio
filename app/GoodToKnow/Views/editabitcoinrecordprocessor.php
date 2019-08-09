<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/EditABitcoinRecordSubmit/page" method="post">
    <h2><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $bitcoin_object->address; ?></h2>
    <?php require SESSIONMESSAGE; ?>
    <p>
        <label for="initial_balance">Initial BTC Balance: </label>
        <input id="initial_balance" name="initial_balance" type="text" placeholder="0.00000000"
               value="<?= $bitcoin_object->initial_balance ?>"
               minlength="10" spellcheck="false" size="17" maxlength="17">
    </p>
    <p>
        <label for="current_balance">Current BTC Balance: </label>
        <input id="current_balance" name="current_balance" type="text" placeholder="0.00000000"
               value="<?= $bitcoin_object->current_balance ?>" required
               minlength="10" spellcheck="false" size="17" maxlength="17">
    </p>
    <p>
        <label for="price_point">BTC Price at Time of Purchase: </label>
        <input id="price_point" name="price_point" type="text" placeholder="0.00"
               value="<?= $bitcoin_object->price_point ?>"
               minlength="2" spellcheck="false" size="13" maxlength="13">
    </p>
    <p>
        <label for="unix_time_at_purchase">Unix Time at Purchase: </label>
        <input id="unix_time_at_purchase" name="unix_time_at_purchase" type="text" placeholder="1560190617"
               value="<?= $bitcoin_object->unix_time_at_purchase ?>"
               minlength="10" size="22" maxlength="22">
    </p>
    <p>
        <label for="comment">Comment (🚫 html 🚫 markdown ✅ emoji ✅ line-break): </label>
        <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800" spellcheck="false"
                  placeholder="This record is for BTC related to _ _ _ _ _."><?= $bitcoin_object->comment ?></textarea>
    </p>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>