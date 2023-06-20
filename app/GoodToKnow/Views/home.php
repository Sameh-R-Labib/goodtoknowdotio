<?php global $g; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <?php if ($g->type_of_resource_requested === 'community') include LISTTOPICS; ?>
        <?php if ($g->type_of_resource_requested === 'topic') include LISTPOSTS; ?>
        <?php if ($g->type_of_resource_requested === 'post') echo $g->post_content ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>
