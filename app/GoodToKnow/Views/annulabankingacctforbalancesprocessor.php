<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Account: </b><?= $g->object->acct_name ?></p>
        <p><b>When: </b><?= $g->object->start_time ?></p>
        <p><b>Balance: </b><?= $g->object->currency ?>&nbsp;<?= $g->object->start_balance ?></p>
        <p><?= $g->object->comment ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want to delete this?</p>
        <section>
            <a href="/ax1/annul_a_banking_acct_for_balances_delete/page/yes" class="choose">Yes</a>
            <a href="/ax1/annul_a_banking_acct_for_balances_delete/page/no" class="choose">No</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>