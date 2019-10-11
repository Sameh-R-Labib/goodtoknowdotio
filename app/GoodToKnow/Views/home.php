<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1><?php include HEADINGONE; ?></h1>
        <?php if ($type_of_resource_requested === 'community') include LISTTOPICS; ?>
        <?php if ($type_of_resource_requested === 'topic') include LISTPOSTS; ?>
        <?php if ($type_of_resource_requested === 'post' AND !empty(trim($post_content))) {
            echo $post_content;
        } else {
            echo '<p><em>[No post content]</em></p>';
        } ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>