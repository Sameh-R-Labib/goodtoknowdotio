<?php global $gtk; ?>
<?php if (!empty($gtk->topic_id)) {
    echo " → <a href=\"/ax1/SetHomePageCommunityTopicPost/page/$gtk->community_id/$gtk->topic_id/0\">$gtk->topic_name</a>";
} ?>