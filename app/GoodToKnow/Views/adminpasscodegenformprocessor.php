<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/4/18
 * Time: 7:38 PM
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/payment-form.css">
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
<h2>Textarea</h2>
<p>The textarea element defines a multi-line input field.</p>

<form action="/ax1/AdminPasscodeGenTextareaForm/page" method="post">
    <h1>Rough Description</h1>
    <p>Required fields are followed by <strong><abbr title="required">*</abbr></strong>.</p>
    <section>
        <h2>Contact information</h2>
        <fieldset>
            <legend>Title</legend>
            <ul>
                <li>
                    <label for="title_1">
                        <input type="radio" id="title_1" name="title" value="M.">
                        Mister
                    </label>
                </li>
                <li>
                    <label for="title_2">
                        <input type="radio" id="title_2" name="title" value="Ms.">
                        Miss
                    </label>
                </li>
            </ul>
        </fieldset>
        <p>
            <label for="name">
                <span>Name: </span>
                <strong><abbr title="required">*</abbr></strong>
            </label>
            <input type="text" id="name" name="username">
        </p>
        <p>
            <label for="mail">
                <span>E-mail: </span>
                <strong><abbr title="required">*</abbr></strong>
            </label>
            <input type="email" id="mail" name="usermail">
        </p>
        <p>
            <label for="pwd">
                <span>Password: </span>
                <strong><abbr title="required">*</abbr></strong>
            </label>
            <input type="password" id="pwd" name="password">
        </p>
        <p>
            <label for="box1">
                <span>Label Text: </span>
                <strong><abbr title="required">*</abbr></strong>
            </label>
            <textarea name="comment" id="box1" rows="10" cols="80" placeholder="How'd we meet?" maxlength="800"
                      wrap="soft">
            </textarea>
        </p>
    </section>
    <section>
        <h2>Payment information</h2>
        <p>
            <label for="card">
                <span>Card type:</span>
            </label>
            <select id="card" name="usercard">
                <option value="visa">Visa</option>
                <option value="mc">Mastercard</option>
                <option value="amex">American Express</option>
            </select>
        </p>
        <p>
            <label for="number">
                <span>Card number:</span>
                <strong><abbr title="required">*</abbr></strong>
            </label>
            <input type="text" id="number" name="cardnumber">
        </p>
        <p>
            <label for="date">
                <span>Expiration date:</span>
                <strong><abbr title="required">*</abbr></strong>
                <em>formatted as mm/yy</em>
            </label>
            <input type="text" id="date" name="expiration">
        </p>
    </section>
    <section>
        <p>
            <input type="submit" name="submit" value="Submit">
        </p>
    </section>
</form>
</body>
</html>