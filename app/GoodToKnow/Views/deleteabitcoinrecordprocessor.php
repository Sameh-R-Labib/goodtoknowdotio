<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/DeleteABitcoinRecordDelete/page" method="post">
    <h2>Confirm</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>&nbsp;</p>
    <p><b>Time of purchase: </b><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $bitcoin_object->unix_time_at_purchase; ?></p>
    <p><b>Address: </b><?= $bitcoin_object->address ?></p>
    <p><b>Price of 1₿ at 🕒 of purchase: </b><?= $bitcoin_object->currency ?>&nbsp;<?= $bitcoin_object->price_point ?>
    </p>
    <p><b>Initial Balance: </b>₿<?= $bitcoin_object->initial_balance ?></p>
    <p><b>Current Balance: </b>₿<?= $bitcoin_object->current_balance ?></p>
    <p>&nbsp;</p>
    <p><?= $bitcoin_object->comment ?></p>
    <p>&nbsp;</p>
    <p>Are you sure you want me to delete "<?= $bitcoin_object->address ?>".</p>
    <section>
        <label for="yes" class="radio">
            <input type="radio" id="yes" name="choice" value="yes">
            Yes<br>
        </label>
        <label for="no" class="radio">
            <input type="radio" id="no" name="choice" value="no">
            No
        </label>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>