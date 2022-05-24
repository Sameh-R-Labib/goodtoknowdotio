<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Delete a Bank Account for Ledger</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Bank Account for Balances?</p>
        <section>
            <?php foreach ($g->array_of_objects as $object): ?>
                <a href="/ax1/annul_a_banking_acct_for_balances_processor/page/<?= $object->id ?>"
                   class="choose"><?= $object->acct_name ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>