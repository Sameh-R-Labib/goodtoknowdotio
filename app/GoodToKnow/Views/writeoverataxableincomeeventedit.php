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
<form action="/ax1/WriteOverATaxableIncomeEventUpdate/page" method="post">
    <h2><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $object->label; ?></h2>
    <p>
        <small>✅ emoji for the label and comment.</small>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="label">Taxable 💸 Event 📽 Label: </label>
            <input id="label" name="label" type="text" value="<?= $object->label ?>" required minlength="3"
                   maxlength="264" size="61" spellcheck="false" placeholder="Customer six month dues.">
        </p>
        <p>
            <label for="time">Unix time for when event occured: </label>
            <input id="time" name="time" type="text" value="<?= $object->time ?>" required minlength="10" maxlength="22"
                   size="22" placeholder="1560190617">
        </p>
        <p>
            <label for="year_received">Year for when event occured: </label>
            <input id="year_received" name="year_received" type="text" value="<?= $object->year_received ?>" required
                   minlength="4" maxlength="6" size="6" placeholder="2018">
        </p>
        <p>
            <label for="currency">Currency (✅ emoji): </label>
            <input id="currency" name="currency" type="text"
                   value="<?= $object->currency ?>" required minlength="1" maxlength="15" size="15">
        </p>
        <p>
            <label for="amount">Amount of currency received: </label>
            <input id="amount" name="amount" type="text"
                   value="<?= $object->amount ?>" required minlength="1" maxlength="16" size="16">
        </p>
        <p>
            <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
            <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800"
                      placeholder="The frequency of this income is _ _ _ _."><?= $object->comment ?></textarea>
        </p>
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