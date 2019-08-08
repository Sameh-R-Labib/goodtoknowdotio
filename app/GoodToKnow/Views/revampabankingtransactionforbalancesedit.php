<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/RevampABankingTransactionForBalancesUpdate/page" method="post">
    <h2><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $object->label; ?></h2>
    <?php require SESSIONMESSAGE; ?>
    <p>
        <small>* Negative (-) amounts mean money you are spending from <b>this</b> account.</small>
    </p>
    <p>
        <label for="label">Label (✅ emoji): </label>
        <input id="label" name="label" type="text"
               value="<?= $object->label ?>" required minlength="3" maxlength="30" size="30" spellcheck="false"
               placeholder="Internet Service Fee">
    </p>
    <p>
        <label for="time">Time (unix time stamp): </label>
        <input id="time" name="time" type="text"
               value="<?= $object->time ?>" minlength="10" maxlength="22" size="22" placeholder="1560190617">
    </p>
    <p>
        <label for="amount">Amount: </label>
        <input id="amount" name="amount" type="text"
               value="<?= $object->amount ?>" required minlength="1" maxlength="16" size="16">
    </p>
    <section>
        <?= $object->bank_id ?>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>