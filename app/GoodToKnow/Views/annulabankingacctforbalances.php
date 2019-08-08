<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/AnnulABankingAcctForBalancesProcessor/page" method="post">
    <h2>Which Banking Account For Balances?</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>These are listed by Banking Account For Balances account name.</p>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($array_of_objects as $key => $object): ?>
            <label for="c<?php echo $key; ?>" class="radio">
                <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                <?= $object->acct_name ?>
            </label>
        <?php endforeach; ?>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>