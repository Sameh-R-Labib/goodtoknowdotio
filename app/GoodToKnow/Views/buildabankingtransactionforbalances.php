<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/BuildABankingTransactionForBalancesProcessor/page" method="post">
        <h1>Create a 🏦ing 🔃 for ⚖️s</h1>
        <p>
            <small>✅ emoji for the label.</small>
        </p>
        <p>
            <small>* Negative (-) amounts mean money you are spending from <b>this</b> account.</small>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">Label: </label>
                <input id="label" name="label" type="text" value="" required minlength="3" maxlength="30"
                       size="30" spellcheck="false" placeholder="Monthly Car Payment">
            </p>
            <p>
                <label for="time">Time (unix time stamp): </label>
                <input id="time" name="time" type="text" value="" required minlength="10" maxlength="22"
                       size="22" placeholder="1560190617">
            </p>
            <p>
                <label for="amount">Amount: </label>
                <input id="amount" name="amount" type="text" value="" required minlength="1" maxlength="16" size="16"
                       placeholder="-105.39">
            </p>
        </section>
        <section>
            <?= $account_type ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>