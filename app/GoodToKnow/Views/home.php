<?php global $post_content; ?>
<?php global $type_of_resource_requested; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <?php include HEADINGONE; ?>
        <?php if ($type_of_resource_requested === 'community') include LISTTOPICS; ?>
        <?php if ($type_of_resource_requested === 'topic') include LISTPOSTS; ?>
        <?php if ($type_of_resource_requested === 'post') echo $post_content ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>