<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/annul_a_banking_acct_for_balances_delete/page" method="post">
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
            <label for="yes" class="radio">
                <input type="radio" id="yes" name="choice" value="yes">
                Yes<br>
            </label>
            <label for="no" class="radio">
                <input type="radio" id="no" name="choice" value="no">
                No
            </label>
        </section>
        <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>