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
<form action="/ax1/DeleteABitcoinRecordDelete/page" method="post">
    <h2>Confirm</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>&nbsp;</p>
    <p><b>Time of purchase: </b><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $bitcoin_object->unix_time_at_purchase; ?></p>
    <p><b>Address: </b><?php echo $bitcoin_object->address; ?></p>
    <p><b>Price of 1₿ at 🕒 of purchase: </b>$<?php echo $bitcoin_object->price_point; ?></p>
    <p><b>Initial Balance: </b>₿<?php echo $bitcoin_object->initial_balance; ?></p>
    <p><b>Current Balance: </b>₿<?php echo $bitcoin_object->current_balance; ?></p>
    <p>&nbsp;</p>
    <p><?php echo $bitcoin_object->comment; ?></p>
    <p>&nbsp;</p>
    <p>Are you sure you want me to delete "<?php /** @noinspection PhpUndefinedVariableInspection */
        echo $bitcoin_object->address; ?>".</p>
    <section>
        <label for="yes" class="radio">
            <input type="radio" id="yes" name="choice" value="yes">
            Yes<br>
        </label>
        <label for="no" class="radio">
            <input type="radio" id="no" name="choice" value="no">
            No
        </label>
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