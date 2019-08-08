<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
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
    <?php if ($type_of_resource_requested === 'community') include LISTTOPICS; ?>
    <?php if ($type_of_resource_requested === 'topic') include LISTPOSTS; ?>
    <?php if ($type_of_resource_requested === 'post') echo $post_content; ?>
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