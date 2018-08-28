<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/27/18
 * Time: 6:44 PM
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
    <a href="https://goodtoknow.io/ax1"><img src="/topbarlogo.png" alt="GoodToKnow.io" height="70" width="302"
                                             style="float: left"></a>
    <div id="sendmessage"><p><a href="#">🖌 Text User</a></p></div>
    <div id="inboxlink"><p><a href="#">📧 Inbox</a></p></div>
    <div id="logindiv"><p><a href="#">🚪 Log In &amp; Out</a></p></div>
</div>
<div id="adminsysmsgdiv">
    <div id="adminsysmsgblock">
        <p>😏 System Message: </p>
        <?php require SESSIONMESSAGE; ?>
    </div>
</div>
<!-- maincontent -->
<div id="maincontent">
    <h2>Admin Scripts</h2>
    <ul>
        <li><a href="#">Generate a pass code for new user registration</a></li>
    </ul>
</div>
<!-- footerbar -->
<div id="footerbar">
    <p align="center" style="font-size: 1em;">Copyright 2018 - Sameh Ramzy Labib</p>
</div>
<script src="/js/script.js"></script>
</body>
</html>