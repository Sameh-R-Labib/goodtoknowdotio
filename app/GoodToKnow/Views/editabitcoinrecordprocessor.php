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
    <title><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $html_title; ?></title>
</head>
<body>
<form action="/ax1/AdminCreateUser/page" method="post">
    <h1><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $bitcoin_object->address; ?></h1>
    <?php require SESSIONMESSAGE; ?>
    <p>
        <label for="initial_balance">Initial BTC Balance: </label>
        <input id="initial_balance" name="initial_balance" type="text" placeholder="0.00000000" value=""
               minlength="10" spellcheck="false" size="17" maxlength="17">
    </p>
    <p>
        <label for="current_balance">Current BTC Balance: </label>
        <input id="current_balance" name="current_balance" type="text" placeholder="0.00000000" value="" required
               minlength="10" spellcheck="false" size="17" maxlength="17">
    </p>
    <p>
        <label for="price_point">BTC Price at Time of Purchase: </label>
        <input id="price_point" name="price_point" type="text" placeholder="0.00" value=""
               minlength="2" spellcheck="false" size="13" maxlength="13">
    </p>
    <p>
        <label for="unix_time_at_purchase">Unix Time at Purchase: </label>
        <input id="unix_time_at_purchase" name="unix_time_at_purchase" type="text" placeholder="1560190617" value=""
               minlength="10" spellcheck="false" size="22" maxlength="22">
    </p>
    <p>
        <label for="comment">Comment: </label>
        <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800"
                  placeholder="This record is for BTC related to _ _ _ _ _."></textarea>
    </p>
    <section>
        <p>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
            <button type="submit" name="submit" value="Submit">Submit</button>
        </p>
    </section>
</form>
</body>
</html>