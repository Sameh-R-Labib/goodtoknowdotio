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
    <a href="/ax1"><img src="/good1.jpg" alt="GoodToKnow.io" height="70" width="302" style="float: left"></a>
    <div id="sendmessage"><?php require SENDMESSAGELINK; ?></div>
    <div id="inboxlink"><p>😘<big>₿</big>🤔🦇</p></div>
    <div id="logindiv"><p>🧠📲🌳🎤🌎📢</p></div>
</div>
<!-- communities -->
<div id="communities">
    <p>👪:&nbsp;&nbsp;<?php require COMMUNITIESFORTHISUSER; ?></p>
</div>
<!-- breadcrumbs -->
<div id="breadcrumbs">
    <p><a href="/ax1/Home/page">⛺</a>:&nbsp;&nbsp;<?php require BREADCRUMBS; ?></p>
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
    <h1>Welcome</h1>
    <p>This site is an instance of the GoodToKnow.io application. The code is GPLv3 Affero licensed FLOSS software.
        The software is meant to facilitate the parsing and sharing of practical useful information.
        This is for sharing amongst family and trusted acquaintances. Each GoodToKnow.io instance is run by at least one
        admin who is in charge of site maintenance and approval of content.</p>
    <p>If you'ld like to become a member of this instance then contact its admin.
        If you stumble across a different instance you can ask its admin to join.
        Otherwise, if you'ld like to have your own instance you can either use the source code yourself found at <a
                href="https://github.com/Sameh-R-Labib/goodtoknowdotio" target="_blank">https://github.com/Sameh-R-Labib/goodtoknowdotio</a>
        or you could contact another admin and persuade them to help you set it up. You'll find the email address
        of each instance's admin on the login page/form.
    </p>
    <p>Thanks and be good to one another. &mdash; <i>Sameh R. Labib</i></p>
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