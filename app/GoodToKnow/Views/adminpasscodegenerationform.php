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
    <h2>Jesus & Burritos</h2>
    <p>Do you think Jesus could microwave a burrito, so hot, the he, himself, could not eat it?</p>
    <form action="">
        <label for="choice-1">
            <input type="radio" id="choice-1" name="choice" value=""/>
            <div>
                No. The Lord can do anything.
                <span>Are you sure?</span>
            </div>
        </label>

        <label for="choice-2">
            <input type="radio" id="choice-2" name="choice" value=""/>
            <div>
                Jesus didn't have microwaves.
                <span>Good point.</span>
            </div>
        </label>

        <label for="choice-3">
            <input type="radio" id="choice-3" name="choice" value=""/>
            <div>
                He had to wait at least 3 minutes.
                <span>Prove it.</span>
            </div>
        </label>

        <label for="choice-4">
            <input type="radio" id="choice-4" name="choice" value=""/>
            <div>
                Depends on what kind of drink he has.
                <span>No it doesn't.</span>
            </div>
        </label>

        <label for="choice-5">
            <input type="radio" id="choice-5" name="choice" value=""/>
            <div>
                Yes. Why was he so special?
                <span>Because he was a Carpenter.</span>
            </div>
        </label>
        <button type="submit">Submit</button>
    </form>
</div> <!-- .form-wrapper -->

<script src="/hiddenradiomessagestooltips/js/index.js"></script>

</body>
</html>