<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Edit a Bank Transaction for Balances</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Bank Transaction For Balances?</p>
        <section>
            <?php foreach ($g->array as $object): ?>
                <a href="/ax1/revamp_a_banking_transaction_for_balances_edit/page/<?= $object->id ?>" class="choose">
                    <b><?= $object->label ?></b> <?= $object->time ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>