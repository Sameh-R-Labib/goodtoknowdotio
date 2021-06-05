<?php global $gtk; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <?php include HEADINGONE; ?>
        <?php if ($gtk->type_of_resource_requested === 'community') include LISTTOPICS; ?>
        <?php if ($gtk->type_of_resource_requested === 'topic') include LISTPOSTS; ?>
        <?php if ($gtk->type_of_resource_requested === 'post') echo $gtk->post_content ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>