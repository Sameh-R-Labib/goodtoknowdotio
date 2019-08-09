<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Home</h1>
        <?php if ($type_of_resource_requested === 'community') include LISTTOPICS; ?>
        <?php if ($type_of_resource_requested === 'topic') include LISTPOSTS; ?>
        <?php if ($type_of_resource_requested === 'post') echo $post_content; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>