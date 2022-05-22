<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/check_my_banking_account_tx_balances_processor/page" method="post">
        <h1>See Transactions</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which one?</p>
        <section>
            <?php foreach ($g->array_of_objects as $key => $object): ?>
                <a href="#" class="choose">Word</a>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <?= $object->acct_name ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>