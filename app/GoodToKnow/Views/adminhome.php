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
    <div id="inboxlink"><p><a href="/ax1/Inbox/page">🎫 inbox</a></p></div>
    <div id="logindiv"><p><a href="/ax1/Logout/page">👋 log out</a></p></div>
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
    <h2 class="topofpage">Regular Member 🧰s</h2>
    <ul>
        <li><a href="/ax1/Upload/page">Upload an 🖼️</a></li>
        <li><a href="/ax1/ByUsernameMessage/page">Username 💬 a User</a></li>
        <li><a href="/ax1/DefaultCommunity/page">Change Default 🧑🏿‍🤝‍🧑🏽</a></li>
        <li><a href="/ax1/ChangePassword/page">Change 🔑</a></li>
        <li><a href="/ax1/CreateNewPost/page">Create 📄</a></li>
        <li><a href="/ax1/EditMyPost/page">Edit 📄</a></li>
        <li><a href="/ax1/AuthorDeletesOwnPost/page">Author Deletes Own 📄</a></li>
        <li><a href="/ax1/InitializeABitcoinRecord/page">Create a ₿ 📽</a></li>
        <li><a href="/ax1/EditABitcoinRecord/page">Edit a ₿ 📽</a></li>
        <li><a href="/ax1/BitcoinSeeMyRecords/page">See all ₿ 📽s</a></li>
        <li><a href="/ax1/DeleteABitcoinRecord/page">Delete a ₿ 📽</a></li>
        <li><a href="/ax1/MakeARecurringPaymentRecord/page">Create a 🌀 💳 📽</a></li>
        <li><a href="/ax1/PolishARecurringPaymentRecord/page">Edit a 🌀 💳 📽</a></li>
        <li><a href="/ax1/RecurringPaymentSeeMyRecords/page">See all 🌀 💳s 📽s</a></li>
        <li><a href="/ax1/ExpungeARecurringPaymentRecord/page">Delete a 🌀 💳 📽</a></li>
        <li><a href="/ax1/GenerateABankingAccountForBalances/page">Create a 🏦 📒 for ⚖️s</a></li>
        <li><a href="/ax1/PopulateABankingAccountForBalances/page">Edit a 🏦 📒 for ⚖️s</a></li>
        <li><a href="/ax1/ViewAllBankingAccountsForBalances/page">See all 🏦 📒s for ⚖️s</a></li>
    </ul>
    <h2>♠👔♠ 🧰s</h2>
    <ul>
        <li><a href="/ax1/NewCommunity/page">Create 🧑🏿‍🤝‍🧑🏽</a></li>
        <li><a href="/ax1/NewTopic/page">Create Topic</a></li>
        <li><a href="/ax1/AdminPassCodeGenerationForm/page">Create Account for Someone</a></li>
        <li><a href="/ax1/PurgeOldMessages/page">Purge Old 💬s</a></li>
        <li><a href="/ax1/GiveCommunitiesToUser/page">Give 🧑🏿‍🤝‍🧑🏽 to User</a></li>
        <li><a href="/ax1/RemoveCommunitiesFromAUser/page">Remove 🧑🏿‍🤝‍🧑🏽 from A User</a></li>
        <li><a href="/ax1/UserRoster/page">User Roster</a></li>
        <li><a href="/ax1/MemberMemoEditor/page">Member's 📝 Editor</a></li>
        <li><a href="/ax1/SuspendAccount/page">Suspend Account</a></li>
        <li><a href="/ax1/UnsuspendAccount/page">Unsuspend Account</a></li>
        <li><a href="/ax1/QuickPostDelete/page">Delete Any 📄</a></li>
        <li><a href="/ax1/TransferPostOwnership/page">Transfer 📄 Ownership</a></li>
        <li><a href="/ax1/KommunityDescriptionEditor/page">🧑🏿‍🤝‍🧑🏽 Description Editor</a></li>
        <li><a href="/ax1/TopicDescriptionEditor/page">Topic Description Editor</a></li>
    </ul>
    <hr>
    <h2 class="topofpage">Instruction to users</h2>
    <p>When writing a post, let it be your goal to concisely write in a manner which helps the reader wrap their head
        around the <em>community's</em> subject matter. Where I said "<em>community</em>" I mean as in our hierarchy:
        community &Rarr; topic &Rarr; post.</p>
    <hr>
    <h2 class="topofpage">Photo Gallery</h2>
    <figure>
        <a href="http://www.fsf.org/associate/support_freedom/join_fsf?referrer=2442">
            <img class="photo" alt="Badge" src="/1944235.png" title="Membership Badge">
        </a>
        <figcaption>My Membership Badge</figcaption>
    </figure>
    <figure>
        <a href="http://www.fsf.org/associate/support_freedom/join_fsf?referrer=2442">
            <img class="photo" alt="Support freedom" src="//static.fsf.org/fsforg/img/normal-image.png"
                 title="Help protect your freedom, join the Free Software Foundation"></a>
        <figcaption>I joined the FSF because I use the GNU Affero version 3 license</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Albert Einstein" src="/thosewhosaidno.jpeg">
        <figcaption>Eccentric Scientist Albert Einstein</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Richard M. Stallman and Julian Assange" src="/0_eT5LwH4rOihgpThm.jpeg">
        <figcaption>Richard M. Stallman and Julian Assange holding up a picture of Edward Snowden</figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Aaron Swartz" src="/Aaron-Swartz.jpg">
        <figcaption>Aaron Swartz (was punished for returning free access to knowledge to <em>its people</em>)
        </figcaption>
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
        <figcaption>Richard D. Wolf professor of economics (explains what Capitalism can learn from Carl Marx)
        </figcaption>
    </figure>
    <figure>
        <img class="photo" alt="Stacey Abrams" src="/stacey_abrams.jpg" height="372" width="655">
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
        <img src="/Gnu-head-30-years-anniversary.svg" style="float:left;height: 32px;width: 32px;margin-top: -6px">
        © 2018 - Sameh Ramzy Labib
        <img src="/2000px-GPLv3_Logo.svg.png"
             height="32" width="70"
             style="float:right;;margin-top: -6px"></p>
</div>
<script src="/js/script.js"></script>
</body>
</html>