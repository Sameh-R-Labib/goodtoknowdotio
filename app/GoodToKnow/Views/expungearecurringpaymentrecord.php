<?php global $array_of_recurring_payment_objects; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/ExpungeARecurringPaymentRecordProcessor/page" method="post">
        <h1>Delete a 🌀 💳 📽</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Recurring Payment Record?</p>
        <section>
            <?php foreach ($array_of_recurring_payment_objects as $key => $rp_object): ?>
                <label for="c<?php echo $key; ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $rp_object->id ?>">
                    <?= $rp_object->label ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>