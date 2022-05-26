<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Label: </b><?= $g->recurring_payment_object->label ?></p>
        <p>Time: <?= $g->recurring_payment_object->time ?></p>
        <p><b>Last's Amount: </b><?= $g->recurring_payment_object->currency ?>
            &nbsp;<?= $g->recurring_payment_object->amount_paid ?></p>
        <p><?= $g->recurring_payment_object->comment ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want me to delete "<?= $g->recurring_payment_object->label ?>".</p>
        <section>
            <a href="/ax1/expunge_a_recurring_payment_record_delete/page/yes" class="choose">Yes</a>
            <a href="/ax1/expunge_a_recurring_payment_record_delete/page/no" class="choose">No</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>