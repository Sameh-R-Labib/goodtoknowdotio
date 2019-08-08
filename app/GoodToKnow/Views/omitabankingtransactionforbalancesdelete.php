<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/OmitABankingTranForBalancesProcessConfirmation/page" method="post">
    <h2>Confirm</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>&nbsp;</p>
    <p><b>Label: </b><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $object->label; ?></p>
    <p>🕒<b>: </b><?= $object->time ?></p>
    <p><b>Amount: </b><?= $object->amount ?></p>
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
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>