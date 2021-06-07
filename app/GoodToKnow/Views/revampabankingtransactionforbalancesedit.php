<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/RevampABankingTransactionForBalancesUpdate/page" method="post">
        <h1>Edit a 🏦ing 🔃 for ⚖️s</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">Negative (-) amounts mean it's money you are spending from this
                account.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">Label (✅ emoji): </label>
                <input id="label" name="label" type="text"
                       value="<?= $g->object->label ?>" required minlength="3" maxlength="30" size="34"
                       spellcheck="false"
                       placeholder="Internet Service Fee">
            </p>
            <hr>
            <p>Time</p>
            <?php require TIMEFORMFIELDPREFILLED; ?>
            <hr>
            <p>
                <label for="amount">Amount <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts to be displayed should have 2 instead of  8 decimal places then ask the admin
                        to add your type of currency to the list of known fiat currencies.</span></span>: </label>
                <input id="amount" name="amount" type="text"
                       value="<?= $g->object->amount ?>" required minlength="1" maxlength="24" size="24"
                       placeholder="-105.39">
            </p>
        </section>
        <section>
            <?= $g->object->bank_id ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>