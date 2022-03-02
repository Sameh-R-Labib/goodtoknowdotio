<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/CheckMyBankingAccountTxBalancesProcessor/page" method="post">
        <h1>See Transactions</h1>
        <p>Which one?</p>
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