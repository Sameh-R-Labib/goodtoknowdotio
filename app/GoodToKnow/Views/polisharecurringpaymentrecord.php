<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Edit a Recurring Payment</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Recurring Payment Record?</p>
        <section>
            <?php foreach ($g->array_of_recurring_payment_objects as $rp_object): ?>
                <a href="/ax1/polish_a_recurring_payment_record_processor/page/<?= $rp_object->id ?>"
                   class="choose"><?= $rp_object->label ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>