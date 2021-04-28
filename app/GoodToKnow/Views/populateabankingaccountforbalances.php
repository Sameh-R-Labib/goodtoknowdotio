<?php global $array_of_objects; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/PopulateABankingAccountForBalancesProcessor/page" method="post">
        <h1>Edit a 🏦ing 📒 for ⚖️s</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Banking Account for Balances?</p>
        <section>
            <?php foreach ($array_of_objects as $key => $object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <?= $object->acct_name ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>