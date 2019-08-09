<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/ExpungeARecurringPaymentRecordDelete/page" method="post">
    <h2>Confirm</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>&nbsp;</p>
    <p><b>Address: </b><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $recurring_payment_object->label; ?></p>
    <p><b>Last's 🕒: </b><?= $recurring_payment_object->unix_time_at_last_payment ?></p>
    <p><b>💱: </b><?= $recurring_payment_object->currency ?></p>
    <p><b>🔢: </b><?= $recurring_payment_object->amount_paid ?></p>
    <p>&nbsp;</p>
    <p><?= $recurring_payment_object->comment ?></p>
    <p>&nbsp;</p>
    <p>Are you sure you want me to delete "<?= $recurring_payment_object->label ?>".</p>
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