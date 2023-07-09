<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/hide_bank_accounts_processor/page" method="post">
    <h1>Hide Bank Accounts</h1>
    <p class="tooltip">ⅈ
        <span class="tooltiptext tooltip-top">Hide the bank accounts you don't want to be presented with.</span>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($g->array_of_objects as $key => $value): ?>
            <label class="checkbox">
                <input type="checkbox" name="choice-<?= $key + 1 ?>" value="<?= $value->id ?>">
                <?= $value->acct_name ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
