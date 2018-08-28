<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/22/18
 * Time: 11:20 PM
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
<!-- topbar -->
<div id="topbar">
    <a href="https://goodtoknow.io/ax1"><img src="/topbarlogo.png" alt="GoodToKnow.io" height="70" width="302"
                                             style="float: left"></a>
    <div id="sendmessage"><p><a href="#">🖌 Text Admin</a></p></div>
    <div id="inboxlink"><p><a href="#">📧 Inbox</a></p></div>
    <div id="logindiv"><p><a href="#">🚪 Log In &amp; Out</a></p></div>
</div>
<!-- communities -->
<div id="communities">
    <p>👪: <a href="#">My First Community</a> ↬ <a href="#">My Second Community</a> ↬ <a href="#">My Third Community</a>
        ↬ <a href="#">My Fourth Community</a> ↬ <a href="#">My Fifth Community</a> ↬ <a href="#">My Fifth Community</a>
        ↬ <a href="#">My Sixth Community</a> ↬ <a href="#">My Seventh Community</a></p>
</div>
<!-- breadcrumbs -->
<div id="breadcrumbs">
    <p>⛺: <a href="#">Current Community</a> → <a href="#">Current Topic</a> → <a href="#">Current Post</a></p>
</div>
<!-- scriptoutput -->
<div id="scriptoutput">
    <div id="sendtoauthor"><p><a href="#">🖌 Text Author</a></p></div>
    <div id="scriptmessage">
        <p>😏 System Message: </p>
        <?php require SESSIONMESSAGE; ?>
    </div>
</div>
<!-- maincontent -->
<div id="maincontent">
