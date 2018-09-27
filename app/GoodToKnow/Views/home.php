<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/13/18
 * Time: 8:50 PM
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
    <a href="https://goodtoknow.io/ax1"><img src="/good1.jpg" alt="GoodToKnow.io" height="70" width="302"
                                             style="float: left"></a>
    <div id="sendmessage"><p><a href="#">♠👔♠ admin</a></p></div>
    <div id="inboxlink"><p><a href="#">🎫 inbox</a></p></div>
    <div id="logindiv"><p><a href="/ax1/Logout/page">👋 log out</a></p></div>
</div>
<!-- communities -->
<div id="communities">
    <p>👪: <?php require COMMUNITIESFORTHISUSER; ?></p>
</div>
<!-- breadcrumbs -->
<div id="breadcrumbs">
    <p>⛺:
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?php echo $community_id; ?>/0/0"><?php echo $special_community_array[$community_id]; ?></a>
        <?php require CURRENTTOPIC; ?><?php require CURRENTPOST; ?></p>
</div>
<!-- scriptoutput -->
<div id="scriptoutput">
    <div id="leftsodiv">
        <div id="sendtoauthor"><p><a href="#">🛎 author</a></p></div>
        <div id="admindiv">
            <div class="tooltip"><a href="/ax1/AdminHome/page"><img src="/cpicon.png" alt="Admin Panel" height="81"
                                                                    width="81"></a>
                <span class="tooltiptext tooltip-top">Don't click</span>
            </div>
        </div>
    </div>
    <div id="scriptmessage">
        <?php require SESSIONMESSAGE; ?>
    </div>
</div>
<!-- maincontent -->
<div id="maincontent">
    <?php if ($type_of_resource_requested === 'community') include LISTTOPICS; ?>
    <?php if ($type_of_resource_requested === 'topic') include LISTPOSTS; ?>
</div><!-- End maincontent -->
<!-- footerbar -->
<div id="footerbar">
    <p align="center" style="font-size: 1em;">Copyright 2018 - Sameh Ramzy Labib</p>
</div>
<script src="/js/script.js"></script>
</body>
</html>