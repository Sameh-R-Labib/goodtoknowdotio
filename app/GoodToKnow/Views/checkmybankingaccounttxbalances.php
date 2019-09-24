<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/CheckMyBankingAccountTxBalancesProcessor/page" method="post">
    <h1>Check my 🏦ing 📋 ⚖️s</h1>
    <p>Which Banking Account for Balances?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($array_of_objects as $key => $object): ?>
            <label for="c<?= $key ?>" class="radio">
                <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                <?= $object->acct_name ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>