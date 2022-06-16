<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Observing Person: </b><?= $g->object->observer_id ?></p>
        <p><b>Bank Account Being Observed: </b><?= $g->object->account_id ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want to delete this?</p>
        <section>
            <a href="/ax1/destroy_a_bank_acct_observer_delete/page/yes" class="choose">Yes</a>
            <a href="/ax1/destroy_a_bank_acct_observer_delete/page/no" class="choose">No</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>