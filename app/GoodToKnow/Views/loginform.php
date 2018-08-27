<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/26/18
 * Time: 9:17 AM
 *
 * This view template is unusual in that
 * it must output all parts (top middle
 * bottom and session message) of the html
 * page.
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
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
<?php require SESSIONMESSAGE; ?>
<p>I'm here on LoginForm.</p>
<div class="login">
    <h2>Log In</h2>
    <fieldset>
        <input type="email" placeholder="Username"/>
        <input type="password" placeholder="Password"/>
    </fieldset>
    <input type="submit" value="Log In"/>
    <div class="utilities">
        <a href="#">Have invite?</a>
        <a href="#">Sign Up &rarr;</a>
    </div>
</div>
</body>
</html>