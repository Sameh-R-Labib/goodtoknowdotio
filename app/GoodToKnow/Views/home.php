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
    <div id="sendmessage"><p><a href="#">♠👔♠</a></p></div>
    <div id="inboxlink"><p><a href="#">🎫 Inbox</a></p></div>
    <div id="logindiv"><p><a href="/ax1/Logout/page">🚪 Log Out</a></p></div>
</div>
<!-- communities -->
<div id="communities">
    <p>👪: <?php require COMMUNITIESFORTHISUSER; ?></p>
</div>
<!-- breadcrumbs -->
<div id="breadcrumbs">
    <p>⛺: <a href="#">Current Community</a> → <a href="#">Current Topic</a> → <a href="#">Current Post</a></p>
</div>
<!-- scriptoutput -->
<div id="scriptoutput">
    <div id="leftsodiv">
        <div id="sendtoauthor"><p><a href="#">🛎</a></p></div>
        <div id="admindiv">
            <div class="tooltip"><a href="/ax1/AdminHome/page"><img src="/cpicon.png" alt="Admin Panel" height="123"
                                                                    width="123"></a>
                <span class="tooltiptext tooltip-top">Don't click</span>
            </div>
        </div>
    </div>
    <div id="scriptmessage">
        <p>😏 System Message:&nbsp;&nbsp;<?php require SESSIONMESSAGE; ?></p>
    </div>
</div>
<!-- maincontent -->
<div id="maincontent">
    <p>Hi there!</p>

    <p>Lorem ipsum amet,
        consectetur adipiscing elit. Phasellus condimentum ipsum quis massa pretium, ut dapibus
        tellus fermentum. Vivamus id elementum orci. Pellentesque habitant morbi tristique senectus et netus et
        malesuada
        fames ac turpis egestas. Cras volutpat sagittis odio consectetur fringilla. Phasellus in nulla ipsum. Nunc
        mauris
        nisi, ornare a fermentum <span class="tooltip">sit<span class="tooltiptext">Tooltip text</span></span>
        vitae, maximus at justo. Nulla tincidunt magna id erat luctus lacinia. Aliquam nec iaculis
        mi. Sed at dolor at libero sollicitudin congue in eu diam. Vestibulum vulputate enim in magna aliquam, sed
        vulputate massa tincidunt. Quisque turpis magna, malesuada vitae lacus vel, tempor consectetur augue.
        Suspendisse
        ut iaculis dui, eu interdum eros. Cras faucibus eros at nulla malesuada condimentum. Nullam ultricies, nisi ac
        tincidunt dapibus, velit odio porttitor mi, eu elementum libero mauris vel risus.</p>

    <p>Integer efficitur efficitur diam sed sagittis. Mauris tincidunt eleifend ligula, nec ornare ipsum. In hac
        habitasse
        platea dictumst. Pellentesque in augue velit. Ut non libero id libero sollicitudin sagittis a id nibh. Praesent
        euismod sem semper, tempor libero id, vehicula sapien. Vestibulum non velit blandit, scelerisque erat semper,
        semper
        ligula. Praesent libero lacus, gravida id tristique at, tempor sit amet nibh. Nam massa sapien, varius ut
        venenatis
        sed, viverra vitae neque. Sed euismod velit in pharetra porta. Aliquam iaculis finibus nulla eget tincidunt. Nam
        porta, lorem vitae placerat eleifend, justo eros blandit massa, et finibus sem erat eu ipsum. Suspendisse
        hendrerit
        iaculis orci, id auctor risus eleifend id.</p>

    <p>Etiam id libero dolor. Phasellus vel fringilla nibh, ut egestas quam. Vivamus ac gravida velit, at faucibus
        lectus.
        Nunc a nulla quis velit euismod aliquet eu id urna. Sed placerat malesuada nisl ac blandit. Duis volutpat
        tristique
        est et aliquam. In non nisl venenatis, porta ligula ac, egestas velit. Pellentesque dui quam, auctor nec nisl
        ut,
        dictum ullamcorper neque. Proin ultricies viverra euismod. Aliquam volutpat, justo luctus placerat ultricies,
        odio
        nisi vehicula felis, aliquet varius enim lacus sed ante. Morbi molestie nibh nec nisi porttitor fringilla.
        Integer
        vel justo ut metus elementum gravida sit amet id elit. Quisque cursus ac purus sed hendrerit. Nullam lectus
        nisi,
        sollicitudin a laoreet vitae, bibendum vitae lorem. In et fermentum urna, at semper erat. Nam eget euismod
        lacus,
        quis malesuada massa.</p>
</div><!-- End maincontent -->
<!-- footerbar -->
<div id="footerbar">
    <p align="center" style="font-size: 1em;">Copyright 2018 - Sameh Ramzy Labib</p>
</div>
<script src="/js/script.js"></script>
</body>
</html>