<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Label: </b><?= $g->object->label ?></p>
        <p>🕒<b>: </b><?= $g->object->time ?></p>
        <p><b>Amount: </b><?= $g->bank->currency ?>&nbsp;<?= $g->object->amount ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want to delete this?</p>
        <section>
            <a href="/ax1/omit_a_banking_tran_for_balances_process_confirmation/page/yes" class="choose">Yes</a>
            <a href="/ax1/omit_a_banking_tran_for_balances_process_confirmation/page/no" class="choose">No</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>