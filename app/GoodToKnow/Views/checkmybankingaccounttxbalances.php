<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <!-- I will use form tags only for style css issues -->
    <form>
        <h1>See Transactions</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which one?</p>
        <section>
            <?php foreach ($g->array_of_objects as $object): ?>
                <a href="/ax1/check_my_banking_account_tx_balances_processor/page/<?= $object->id ?>"
                   class="choose"><?= $object->acct_name ?></a>
                <br>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>