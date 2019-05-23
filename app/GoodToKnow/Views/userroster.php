<!DOCTYPE html>
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
    <a href="/ax1"><img src="/good1.jpg" alt="GoodToKnow.io" height="64" width="292" style="float: left"></a>
    <div id="sendmessage"><?php require SENDMESSAGELINK; ?></div>
    <div id="inboxlink"><p><a href="/ax1/ByUsernameMessage/page">U/N 📧 👲</a></p></div>
    <div id="logindiv"><p><a href="/ax1/Logout/page">👋 log out</a></p></div>
</div>
<!-- communities -->
<div id="communities">
    <p>👪:&nbsp;&nbsp;<?php require COMMUNITIESFORTHISUSER; ?></p>
</div>
<!-- breadcrumbs -->
<div id="breadcrumbs">
    <p>⛺:&nbsp;&nbsp;<?php require BREADCRUMBS; ?></p>
</div>
<!-- scriptoutput -->
<div id="scriptoutput">
    <div id="leftsodiv">
        <div id="sendtoauthor"><?php require MESSAGETHEAUTHOR; ?></p></div>
        <div id="admindiv">
            <?php require CONTROLPANELLINK; ?>
        </div>
    </div>
    <div id="scriptmessage">
        <?php require SESSIONMESSAGE; ?>
    </div>
</div>
<!-- maincontent -->
<div id="maincontent">
    <?php if (!empty($readable_user_objects_array)): ?>
        <?php $last = count($readable_user_objects_array) - 1; ?>
        <?php foreach ($readable_user_objects_array as $key => $user): ?>
            <p>&nbsp;</p>
            <p><b>U/N:&nbsp;&nbsp;</b><?php echo $user->username; ?></p>
            <p><b>Default Community:&nbsp;&nbsp;</b><?php echo $user->readable_community_name; ?></p>
            <p><b>Title:&nbsp;&nbsp;</b><?php echo $user->title; ?></p>
            <p><b>Role:&nbsp;&nbsp;</b><?php echo $user->readable_role; ?></p>
            <p><b>Race:&nbsp;&nbsp;</b><?php echo $user->readable_race; ?></p>
            <p><b>Is-Suspended:&nbsp;&nbsp;</b><?php echo $user->readable_is_suspended; ?></p>
            <p><b>Date:&nbsp;&nbsp;</b><?php echo $user->date; ?></p>
            <p>&nbsp;</p>
            <p><b>Comment:&nbsp;&nbsp;</b><?php echo $user->comment; ?></p>
            <p>&nbsp;</p>
            <?php if ($key != $last): ?>
                <hr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No users found in the system.</p>
    <?php endif; ?>
</div><!-- End maincontent -->
<!-- footerbar -->
<div id="footerbar">
    <p align="center" style="font-size: 1em;">
        <img src="/Gnu-head-30-years-anniversary.svg" style="float:left;height: 32px;width: 32px;margin-top: -6px">
        © 2018 - Sameh Ramzy Labib
        <img src="/2000px-GPLv3_Logo.svg.png"
             height="32" width="70"
             style="float:right;;margin-top: -6px"></p>
</div>
<script src="/js/script.js"></script>
</body>
</html>