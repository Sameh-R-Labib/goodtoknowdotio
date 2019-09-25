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
            <?php require TIMEFORMFIELD; ?>
            <p>
                <label for="time">Time (unix time stamp): </label>
                <input id="time" name="time" type="text" value="" required minlength="10" maxlength="22"
                       size="22" placeholder="1546300800">
            </p>
            <p>
                <label for="amount">Amount: </label>
                <input id="amount" name="amount" type="text" value="" required minlength="1" maxlength="16" size="16"
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