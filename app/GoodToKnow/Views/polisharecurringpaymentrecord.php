<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/polish_a_recurring_payment_record_processor/page" method="post">
        <h1>Edit a Recurring Payment</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Recurring Payment Record?</p>
        <section>
            <?php foreach ($g->array_of_recurring_payment_objects as $key => $rp_object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $rp_object->id ?>">
                    <?= $rp_object->label ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>