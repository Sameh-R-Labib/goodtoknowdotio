<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/BuildABankingTransactionForBalancesProcessor/page" method="post">
        <h1>Create a 🏦ing 🔃 for ⚖️s</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">A negative (-) amount shall signify money spent.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">Label (✅ emoji): </label>
                <input id="label" name="label" type="text" value="" required minlength="3" maxlength="30"
                       size="34" spellcheck="false" placeholder="Monthly Car Payment">
            </p>
            <hr>
            <p>Time</p>
            <?php require TIMEFORMFIELD; ?>
            <hr>
            <p>
                <label for="amount">Amount <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts are being displayed having 8 instead of 2 decimal places then let the admin
                        know to add your type of currency to the list of known fiat currencies.</span></span>: </label>
                <input id="amount" name="amount" type="text" value="" required minlength="1" maxlength="24" size="24"
                       placeholder="-105.39">
            </p>
        </section>
        <section>
            <?= /** @noinspection PhpUndefinedVariableInspection */
            $account_type ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>