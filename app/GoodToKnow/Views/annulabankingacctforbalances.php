<?php global $array_of_objects; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/AnnulABankingAcctForBalancesProcessor/page" method="post">
        <h1>Delete a 🏦ing 📒 for ⚖️s</h1>
        <p>Which Banking Account for Balances?</p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($array_of_objects as $key => $object): ?>
                <label for="c<?php echo $key; ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <?= $object->acct_name ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>