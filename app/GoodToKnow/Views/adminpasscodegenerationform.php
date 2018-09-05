<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/27/18
 * Time: 10:05 PM
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="/hiddenradiomessagestooltips/css/style.css">
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
<div class="form-wrapper">
    <h2>Generate Pass-Code</h2>
    <p><font color="red"><?php require SESSIONMESSAGE; ?></font></p>
    <p>A pass-code gets used to create a new user account or to add a community membership to an existing account.</p>
    <p>Which community do I want this user to become a member of?</p>
    <form action="/ax1/AdminPassCodeGenFormProcessor/script" method="post">

        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($community_array as $key => $value): ?>
            <label for="choice-<?php echo $key + 1; ?>">
                <input type="radio" id="choice-<?php echo $key + 1; ?>" name="choice"
                       value="<?php echo $value->id; ?>"/>
                <div>
                    <?php echo $value->community_name; ?>
                    <span><?php echo $value->community_description; ?></span>
                </div>
            </label>

        <?php endforeach; ?>
        <button type="submit" name="submit" value="Submit">Submit</button>
    </form>
</div> <!-- .form-wrapper -->

<script src="/hiddenradiomessagestooltips/js/index.js"></script>

</body>
</html>