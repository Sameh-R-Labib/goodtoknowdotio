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
<form action="/ax1/PolishARecurringPaymentRecordSubmit/page" method="post">
    <h2><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $recurring_payment_object->label; ?></h2>
    <?php require SESSIONMESSAGE; ?>
    <p>
        <label for="label">Label (No Emoji!): </label>
        <input id="label" name="label" type="text" value="<?php /** @noinspection PhpUndefinedVariableInspection */
        echo $recurring_payment_object->label; ?>" required minlength="4" maxlength="264" size="67">
    </p>
    <p>
        <label for="currency">Currency (Any UTF-8 character - No Emoji!): </label>
        <input id="currency" name="currency" type="text"
               value="<?php /** @noinspection PhpUndefinedVariableInspection */
               echo $recurring_payment_object->currency; ?>" required minlength="1" maxlength="15" size="15">
    </p>
    <p>
        <label for="amount_paid">Amount of currency paid: </label>
        <input id="amount_paid" name="amount_paid" type="text"
               value="<?php /** @noinspection PhpUndefinedVariableInspection */
               echo $recurring_payment_object->amount_paid; ?>" required minlength="1" maxlength="16" size="16">
    </p>
    <p>
        <label for="unix_time_at_last_payment">Unix time at last payment: </label>
        <input id="unix_time_at_last_payment" name="unix_time_at_last_payment" type="text"
               value="<?php /** @noinspection PhpUndefinedVariableInspection */
               echo $recurring_payment_object->unix_time_at_last_payment; ?>" minlength="10" maxlength="22"
               size="22" placeholder="1560190617">
    </p>
    <p>
        <label for="comment">Comment (No html. No Emoji. UTF-8 is okay. Line breaks will be automatically replaced with
            &lt;br&gt;): </label>
        <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800" required
                  placeholder="The frequency of this payment is _ _ _ _."><?php /** @noinspection PhpUndefinedVariableInspection */
            echo $recurring_payment_object->comment; ?></textarea>
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