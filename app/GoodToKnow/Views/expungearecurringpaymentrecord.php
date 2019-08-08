<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/ExpungeARecurringPaymentRecordProcessor/page" method="post">
    <h2>Which RecurringPayment Record?</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>These are listed by RecurringPayment label.</p>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($array_of_recurring_payment_objects as $key => $rp_object): ?>
            <label for="c<?php echo $key; ?>" class="radio">
                <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $rp_object->id ?>">
                <?= $rp_object->label ?>
            </label>
        <?php endforeach; ?>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>