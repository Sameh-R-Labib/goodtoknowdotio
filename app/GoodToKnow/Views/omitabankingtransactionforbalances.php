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
<form action="/ax1/OmitABankingTransactionForBalancesTimeRange/page" method="post">
    <h1>Delete a 🏦ing 🔃 for ⚖️s</h1>
    <h2>Narrow down the selection for choosing 🔃</h2>
    <p>Which time range does the transaction fall under?</p>
    <section>
        <label for="A" class="radio">
            <input type="radio" id="A" name="choice" value="A">
            Last 30 days<br>
        </label>
        <label for="B" class="radio">
            <input type="radio" id="B" name="choice" value="B">
            30 - 60 day range<br>
        </label>
        <label for="C" class="radio">
            <input type="radio" id="C" name="choice" value="C">
            60 - 90 day range<br>
        </label>
        <label for="D" class="radio">
            <input type="radio" id="D" name="choice" value="D">
            Beyond 90 days<br>
        </label>
        <label for="E" class="radio">
            <input type="radio" id="E" name="choice" value="E">
            All<br>
        </label>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
</body>
</html>