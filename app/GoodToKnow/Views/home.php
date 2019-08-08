<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
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