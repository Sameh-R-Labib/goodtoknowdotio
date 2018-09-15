<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/11/18
 * Time: 12:40 PM
 */
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/styles.css">
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
<!-- adminhometop -->
<div id="adminhometop">
    <a href="https://goodtoknow.io/ax1"><img src="/good1.jpg" alt="GoodToKnow.io" height="70" width="302"
                                             style="float: left"></a>
</div>
<!-- communities -->
<div id="communities">
    &nbsp;
</div>
<!-- breadcrumbs -->
<div id="breadcrumbs">
    &nbsp;
</div>
<!-- scriptoutput -->
<div id="scriptoutput">
    <div id="adminsysmsgblock">
        <p>😏 System Message:&nbsp;&nbsp;<?php require SESSIONMESSAGE; ?></p>
    </div>
</div>
<!-- maincontent -->
<div id="maincontent">
    <h2>Infinite Loop Prevention</h2>
    <p>You've arrived at this page because something went wrong. Either it is a simple anomaly
        where your session expired while you were using this app. Or, it is a serious mistake in the app's
        logic.</p>
    <p>If the former then just go back to the log in page and log in. If its the later then please
        notify the admin.</p>
</div>
<!-- footerbar -->
<div id="footerbar">
    <p align="center" style="font-size: 1em;">Copyright 2018 - Sameh Ramzy Labib</p>
</div>
<script src="/js/script.js"></script>
</body>
</html>