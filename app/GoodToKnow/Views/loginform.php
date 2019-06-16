<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/loginform.css">
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
<form class="login" action="/ax1/LoginScript/page" method="post">
    <h2>Log In</h2>
    <fieldset>
        <input type="text" name="username" spellcheck="false" placeholder="Username" minlength="7" required>
        <input type="password" name="password" spellcheck="false" placeholder="Password" minlength="7" required>
    </fieldset>
    <input type="submit" value="Log In">
    <div class="utilities">
        <a href="/ax1/WhatIsThisSite/page">What is this site?</a>
        <a href="#">BTC_Maximalist &rarr; protonmail.com</a>
        <?php require SESSIONMESSAGE; ?>
    </div>
</form>
</body>
</html>