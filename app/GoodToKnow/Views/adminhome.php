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
    <div id="sendmessage"><?php require SENDMESSAGELINK; ?></div>
    <div id="inboxlink"><p><a href="/ax1/Inbox/page">🎫 inbox</a></p></div>
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
    <h1>Admin Scripts</h1>
    <ul>
        <li><a href="/ax1/AdminPassCodeGenerationForm/page">Create Account for Someone</a></li>
        <li><a href="/ax1/DefaultCommunity/page">Change Default Community</a></li>
        <li><a href="/ax1/ChangePassword/page">Change Password</a></li>
        <li><a href="/ax1/CreateNewPost/page">Create Post</a></li>
        <li><a href="/ax1/NewTopic/page">Create Topic</a></li>
        <li><a href="/ax1/EditMyPost/page">Edit Post</a></li>
        <li><a href="/ax1/ByUsernameMessage/page">Username Message a User</a></li>
    </ul>
    <figure>
        <a href="http://www.fsf.org/associate/support_freedom/join_fsf?referrer=2442">
            <img class="photo" alt="Support freedom" src="//static.fsf.org/fsforg/img/normal-image.png"
                 title="Help protect your freedom, join the Free Software Foundation"/></a>
        <figcaption>I joined the FSF because I use the GNU Affero version 3 license</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Richard M. Stallman and Julian Assange" src="/0_eT5LwH4rOihgpThm.jpeg">
        <figcaption>Richard M. Stallman and Julian Assange holding up a picture of Edward Snowden</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Aaron Swartz" src="/Aaron-Swartz.jpg">
        <figcaption>Aaron Swartz (was crushed by our system of government)</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Ross Ulbricht" src="/Ross-Ulbricht2.jpg">
        <figcaption>Ross Ulbricht (whose mistrial gave him a double life sentence plus forty years without the
            possibility of parole)
        </figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Edward Snowden" src="/edward_snowden.jpg">
        <figcaption>Edward Snowden (CIA whistle blower living in exile)</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Andreas Antonopoulos" src="/andreas_antonopoulos.jpg">
        <figcaption>Andreas Antonopoulos (Bitcoin evangelist)</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Richard D. Wolf" src="/richard_d_wolff.jpg">
        <figcaption>Richard D. Wolf professor of economics</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Stacey Abrams" src="/stacey_abrams.jpg" height="360" width="641">
        <figcaption>Stacey Abrams (represents to me being a victim of voter suppression)</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Abby Martin" src="/AbbyMartinVenezuela.jpg">
        <figcaption>Abby Martin (reporter who speaks up about US interventionism in South American)</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Bernie Sanders" src="/burnie_sanders.jpg">
        <figcaption>Bernie Sanders (fights war overspending)</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Chris Hedges" src="/chris_hedges.jpg">
        <figcaption>Chris Hedges (book author who speaks against corruption in government)</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Film: The Panama Deception" src="/usattack.png">
        <figcaption>Documentary war film showing actual footage of the Panama invasion called The Panama Deception
        </figcaption>
    </figure>
</div>
<!-- footerbar -->
<div id="footerbar">
    <p align="center" style="font-size: 1em;">
        <img src="/powered-by-gnu.png" style="float:left;height: 27px;width: 27px">
        2018 - Sameh Ramzy Labib
        <img src="/2000px-GPLv3_Logo.svg.png"
             height="27" width="65"
             style="float:right;"></p>
</div>
<script src="/js/script.js"></script>
</body>
</html>