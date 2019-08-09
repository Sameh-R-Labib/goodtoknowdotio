<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/BuildABankingTransactionForBalancesProcessor/page" method="post">
    <h1>Create a 🏦ing 🔃 for ⚖️s</h1>
    <h2>Initialize the banking transaction for balances record with its label and time</h2>
    <p>
        <small>✅ emoji for the label.</small>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="label">🏦ing 🔃 for ⚖️ Label: </label>
            <input id="label" name="label" type="text" value="" required minlength="3" maxlength="30"
                   size="30" spellcheck="false" placeholder="Monthly Car Payment">
        </p>
        <p>
            <label for="time">Unix time at Beginning: </label>
            <input id="time" name="time" type="text" value="" required minlength="10" maxlength="22"
                   size="22" placeholder="1560190617">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>