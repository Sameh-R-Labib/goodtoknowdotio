<?php require TOPOFREGULARPAGE; ?>
<!-- topbar -->
<div id="topbar">
    <a href="/ax1"><img src="/good1.jpg" alt="GoodToKnow.io" height="70" width="302" style="float: left"></a>
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
    <?php if (!empty($array_of_objects)): ?>
        <?php $last = count($array_of_objects) - 1; ?>
        <?php foreach ($array_of_objects as $key => $object): ?>
            <h2 class="topofpage"><?= $object->acct_name ?></h2>
            <p><b>Start 🕒: </b><?= $object->start_time ?></p>
            <p><b>Start ⚖️: </b><?= $object->start_balance ?></p>
            <p><?= $object->comment ?></p>
            <?php if ($key != $last): ?>
                <hr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>There are no banking accounts for balances for you.</p>
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
<?php require BOTTOMOFPAGES; ?>