<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/ExpungeARecurringPaymentRecordDelete/page" method="post">
    <h2>Confirm</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>&nbsp;</p>
    <p><b>Label: </b><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $recurring_payment_object->label; ?></p>
    <p><b>Last's 🕒: </b><?= $recurring_payment_object->time ?></p>
    <p><b>Last's Amount: </b><?= $recurring_payment_object->currency ?>
        &nbsp;<?= $recurring_payment_object->amount_paid ?></p>
    <p><?= $recurring_payment_object->comment ?></p>
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