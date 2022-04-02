<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/omit_a_banking_transaction_for_balances_delete/page" method="post">
        <h1>Delete a Bank Transaction for Balances</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Bank Transaction For Balances?</p>
        <section>
            <?php foreach ($g->array as $key => $object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <b><?= $object->label ?></b> <?= $object->time ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>