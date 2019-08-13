<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/NukeATaxableIncomeEventConfirmation/page" method="post">
    <h2>Confirm</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>&nbsp;</p>
    <p><b>Label: </b><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $object->label; ?></p>
    <p><b>Year: </b><?= $object->year_received ?></p>
    <p><b>Time: </b><?= $object->time ?></p>
    <p><b>Amount: </b><?= $object->currency ?>&nbsp;<?= $object->amount ?></p>
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