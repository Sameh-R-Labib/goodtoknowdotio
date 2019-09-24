<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/OmitABankingTransactionForBalancesDelete/page" method="post">
    <h1>Delete a Banking Transaction for Balances</h1>
    <?php require SESSIONMESSAGE; ?>
    <p>Which Banking Transaction For Balances?</p>
    <section>
        <?php foreach ($array as $key => $object): ?>
            <label for="c<?= $key ?>" class="radio">
                <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                <b><?= $object->label ?></b> <?= $object->time ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>