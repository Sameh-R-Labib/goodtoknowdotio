<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/editor.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title><?= $html_title ?></title>
</head>
<body>
<form action="/ax1/BuildABankingTransactionForBalancesProcessor/page" method="post">
    <h2>Initialize the banking_transaction_for_balances record with its label and time</h2>
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
    <section>
        <p>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
            <button type="submit" name="submit" value="Submit">Submit</button>
        </p>
    </section>
</form>
</body>
</html>