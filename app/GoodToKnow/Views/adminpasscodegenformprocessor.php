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
<form action="/ax1/AdminCreateUser/page" method="post">
    <h1>User</h1>
    <p><font color="red"><?php require SESSIONMESSAGE; ?></font></p>
    <p>Required = <strong><abbr title="required">*</abbr></strong>.</p>
    <section>
        <h2>Log-in Credentials</h2>
        <p>The rules for the username: Must consist of two words separated by an underscore.
            The first word must start with an upper case letter.
            That first letter is the only uppercase letter.
            The first word must be 4 to 9 characters in length.
            The second word is numeric two digits long.</p>
        <p>
            <label for="name">
                <span>Username: </span>
                <strong><abbr title="required">*</abbr></strong>
                <em>like Buddy_52</em>
            </label>
            <input type="text" id="name" name="username">
        </p>
        <p>
            <label for="first_try">
                <span>Password 1st try: </span>
                <strong><abbr title="required">*</abbr></strong>
            </label>
            <input type="password" id="first_try" name="first_try">
        </p>
        <p>
            <label for="pwd">
                <span>Password 2nd try: </span>
                <strong><abbr title="required">*</abbr></strong>
            </label>
            <input type="password" id="pwd" name="password">
        </p>
        <p>The rules for the password: 10 to 18 characters, 2 digits, 2 or more non-alpha, 2 or more capitals.</p>
    </section>
    <section>
        <h2>Person's Characteristics</h2>
        <p align="center"><abbr title="required">*</abbr></strong></p>
        <fieldset>
            <legend>Title <strong></legend>
            <ul>
                <li>
                    <label for="title_1">
                        <input type="radio" id="title_1" name="title" value="Mr">
                        Mister
                    </label>
                </li>
                <li>
                    <label for="title_2">
                        <input type="radio" id="title_2" name="title" value="Ms">
                        Miss
                    </label>
                </li>
            </ul>
        </fieldset>
        <p>
            <label for="card">
                <span>Race: <strong><abbr title="required">*</abbr></strong></span>
            </label>
            <select id="card" name="race">
                <option value="caucasian-american">Caucasian American</option>
                <option value="caucasian-european">Caucasian European</option>
                <option value="caucasian-african">Caucasian African</option>
                <option value="black-european">Black European</option>
                <option value="black-american">Black American</option>
                <option value="black-african">Black African</option>
                <option value="asian">Asian</option>
                <option value="south-american">South American</option>
                <option value="greek">Greek</option>
                <option value="middle-eastern-christian">Middle Eastern Christian</option>
                <option value="middle-eastern-moslem">Middle Eastern Moslem</option>
                <option value="native-american">Native American</option>
            </select>
        </p>
        <p>
            <label for="box1">
                <span>Description: </span>
                <strong><abbr title="required">*</abbr></strong>
            </label>
            <textarea name="comment" id="box1" rows="10" cols="80" maxlength="800" wrap="soft">How'd we meet?</textarea>
        </p>
        <p>
            <label for="date">
                <span>Today's date:</span>
                <strong><abbr title="required">*</abbr></strong>
                <em>USA mm/dd/yyyy</em>
            </label>
            <input type="text" id="date" name="date">
        </p>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Create Account</button>
        </p>
    </section>
</form>
</body>
</html>