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
<form action="/ax1/ExpungeARecurringPaymentRecordDelete/page" method="post">
    <h2>Confirm</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>&nbsp;</p>
    <p><b>Address: </b><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $recurring_payment_object->label; ?></p>
    <p><b>Last's 🕒: </b><?php echo $recurring_payment_object->unix_time_at_last_payment; ?></p>
    <p><b>💱: </b><?php echo $recurring_payment_object->currency; ?></p>
    <p><b>🔢: </b><?php echo $recurring_payment_object->amount_paid; ?></p>
    <p>&nbsp;</p>
    <p><?php echo $recurring_payment_object->comment; ?></p>
    <p>&nbsp;</p>
    <p>Are you sure you want me to delete "<?php /** @noinspection PhpUndefinedVariableInspection */
        echo $recurring_payment_object->label; ?>".</p>
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