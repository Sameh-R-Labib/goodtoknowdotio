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
<form action="/ax1/ConceiveAPossibleTaxDeductionProcessor/page" method="post">
    <h2>Initialize the possible_tax_deduction record with its label and year_paid</h2>
    <p>
        <small>✅ emoji for the label.</small>
    </p>
    <p>
        <small>year_paid is the year in which you spent the money.</small>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="label">🏦ing 🔃 for ⚖️ Label: </label>
            <input id="label" name="label" type="text" value="" required minlength="3" maxlength="264"
                   size="96" spellcheck="false"
                   placeholder="Monthly Linode hosting Fees for Web server of goodtoknow.io">
        </p>
        <p>
            <label for="year_paid">Year You Made The Expenditure: </label>
            <input id="year_paid" name="year_paid" type="text" value="" required minlength="4" maxlength="6"
                   size="6" placeholder="2018">
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