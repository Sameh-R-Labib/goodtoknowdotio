<?php global $g; ?>
<?php if (!empty($g->topic_id)) {
    echo " → <a href=\"/ax1/SetHomePageCommunityTopicPost/page/$g->community_id/$g->topic_id/0\">$g->topic_name</a>";
} ?>