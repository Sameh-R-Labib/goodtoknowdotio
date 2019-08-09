<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/AnnulABankingAcctForBalancesDelete/page" method="post">
    <h2>Confirm</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>&nbsp;</p>
    <p><b>Account: </b><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $object->acct_name; ?></p>
    <p><b>Start 🕒: </b><?= $object->start_time ?></p>
    <p><b>Start ⚖️: </b><?= $object->start_balance ?></p>
    <p>&nbsp;</p>
    <p><?= $object->comment ?></p>
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