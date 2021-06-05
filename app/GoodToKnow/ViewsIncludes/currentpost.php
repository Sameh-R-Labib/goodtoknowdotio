<?php global $gtk; ?>
<?php if (!empty($gtk->post_id)) {
    echo " → <a
    href=\"/ax1/SetHomePageCommunityTopicPost/page/$gtk->community_id/$gtk->topic_id/$gtk->post_id\">
    $gtk->post_name</a>";
} ?>