<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/PopulateABankingAccountForBalancesProcessor/page" method="post">
    <h1>Edit a 🏦ing 📒 for ⚖️s</h1>
    <h2>Which Banking Account for Balances?</h2>
    <p>Choose:</p>
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
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>