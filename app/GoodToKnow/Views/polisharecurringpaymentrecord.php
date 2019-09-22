<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/PolishARecurringPaymentRecordProcessor/page" method="post">
    <h1>Edit a 🌀 💳 📽</h1>
    <p>Which RecurringPayment Record?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($array_of_recurring_payment_objects as $key => $rp_object): ?>
            <label for="c<?= $key ?>" class="radio">
                <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $rp_object->id ?>">
                <?= $rp_object->label ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>