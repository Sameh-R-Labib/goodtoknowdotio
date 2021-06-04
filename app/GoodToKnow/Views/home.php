<?php global $app_state; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <?php include HEADINGONE; ?>
        <?php if ($app_state->type_of_resource_requested === 'community') include LISTTOPICS; ?>
        <?php if ($app_state->type_of_resource_requested === 'topic') include LISTPOSTS; ?>
        <?php if ($app_state->type_of_resource_requested === 'post') echo $app_state->post_content ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>