<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/AnnulABankingAcctForBalancesProcessor/page" method="post">
        <h1>Delete a Bank Account for Ledger</h1>
        <p>Which Bank Account for Balances?</p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->array_of_objects as $key => $object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <?= $object->acct_name ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>