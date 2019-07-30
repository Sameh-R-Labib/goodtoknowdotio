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
<form action="/ax1/RevampABankingTransactionForBalancesUpdate/page" method="post">
    <h2><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $object->label; ?></h2>
    <?php require SESSIONMESSAGE; ?>
    <p>
        <small>* Negative (-) amounts mean money you are spending from <b>this</b> account.</small>
    </p>
    <p>
        <label for="label">Label (✅ emoji): </label>
        <input id="label" name="label" type="text"
               value="<?= $object->label ?>" required minlength="3" maxlength="30" size="30" spellcheck="false"
               placeholder="Internet Service Fee">
    </p>
    <p>
        <label for="time">Time (unix time stamp): </label>
        <input id="time" name="time" type="text"
               value="<?= $object->time ?>" minlength="10" maxlength="22" size="22" placeholder="1560190617">
    </p>
    <p>
        <label for="amount">Amount: </label>
        <input id="amount" name="amount" type="text"
               value="<?= $object->amount ?>" required minlength="1" maxlength="16" size="16">
    </p>
    <section>
        <?= $object->bank_id ?>
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