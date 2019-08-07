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
    <?php if (!empty($array)): ?>
        <?php $last = count($array) - 1; ?>
        <?php foreach ($array as $key => $object): ?>
            <h2 class="topofpage"><?= $object->label ?></h2>
            <p><b>Last 🕒: </b><?= $object->last ?></p>
            <p><b>Next 🕒: </b><?= $object->next ?></p>
            <p><b>Cycle Type: </b><?= $object->cycle_type ?></p>
            <p><?= $object->comment ?></p>
            <?php if ($key != $last): ?>
                <hr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>There are no to-do tasks for you.</p>
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