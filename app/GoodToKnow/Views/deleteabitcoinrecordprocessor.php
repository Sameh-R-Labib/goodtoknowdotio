<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/DeleteABitcoinRecordDelete/page" method="post">
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Time of purchase: </b><?php echo $g->bitcoin_object->time; ?></p>
        <p><b>Address: </b><?= $g->bitcoin_object->address ?></p>
        <p><b>Price of 1₿ at 🕒 of purchase: </b><?= $g->bitcoin_object->currency ?>
            &nbsp;<?= $g->bitcoin_object->price_point ?>
        </p>
        <p><b>Initial Balance: </b>₿&nbsp;<?= $g->bitcoin_object->initial_balance ?></p>
        <p><b>Current Balance: </b>₿&nbsp;<?= $g->bitcoin_object->current_balance ?></p>
        <p><?= $g->bitcoin_object->comment ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want me to delete "<?= $g->bitcoin_object->address ?>".</p>
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