<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Label: </b><?= $g->object->label ?></p>
        <p><b>Year: </b><?= $g->object->year_received ?></p>
        <p><b>Time: </b><?= $g->object->time ?></p>
        <p><b>Amount: </b><?= $g->object->currency ?>&nbsp;<?= $g->object->amount ?></p>
        <p><b>Value of one unit of amount: </b><?= $g->object->fiat ?>&nbsp;<?= $g->object->price ?></p>
        <p><?= $g->object->comment ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want to delete this?</p>
        <section>
            <a href="/ax1/nuke_a_taxable_income_event_confirmation/page/yes" class="choose">Yes</a>
            <a href="/ax1/nuke_a_taxable_income_event_confirmation/page/no" class="choose">No</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>