<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Label: </b><?= $g->object->label ?></p>
        <p><b>Year Paid: </b><?= $g->object->year_paid ?></p>
        <p><?= $g->object->comment ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want to delete this?</p>
        <section>
            <a href="/ax1/wipe_out_a_possible_tax_deduction_confirmation/page/yes" class="choose">Yes</a>
            <a href="/ax1/wipe_out_a_possible_tax_deduction_confirmation/page/no" class="choose">No</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>