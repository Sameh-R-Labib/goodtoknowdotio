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
<!-- adminhometop -->
<div id="adminhometop">
    <a href="https://goodtoknow.io/ax1"><img src="/good1.jpg" alt="GoodToKnow.io" height="70" width="302"
                                             style="float: left"></a>
    <div id="sendmessage"><p><a href="#">👲 user</a></p></div>
    <div id="inboxlink"><p><a href="#">🎫 inbox</a></p></div>
    <div id="logindiv"><p><a href="/ax1/Logout/page">👋 log out</a></p></div>
</div>
<!-- communities -->
<div id="communities">
    &nbsp;
</div>
<!-- breadcrumbs -->
<div id="breadcrumbs">
    &nbsp;
</div>
<!-- soplaceholder -->
<div id="soplaceholder">
    <?php require SESSIONMESSAGE; ?>
</div>
<!-- maincontent -->
<div id="maincontent">
    <h2>Admin Scripts</h2>
    <ul>
        <li><a href="/ax1/AdminPassCodeGenerationForm/page">Create Account for Someone</a></li>
        <li><a href="/ax1/DefaultCommunity/page">Change Default Community</a></li>
        <li><a href="/ax1/ChangePassword/page">Change Password</a></li>
        <li><a href="/ax1/CreateNewPost/page">Create Post</a></li>
        <li><a href="/ax1/NewTopic/page">Create Topic</a></li>
        <li><a href="/ax1/EditMyPost/page">Edit Post</a></li>
    </ul>
</div>
<!-- footerbar -->
<div id="footerbar">
    <p align="center" style="font-size: 1em;">Copyright 2018 - Sameh Ramzy Labib</p>
</div>
<script src="/js/script.js"></script>
</body>
</html>