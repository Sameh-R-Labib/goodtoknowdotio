<?php global $g; ?>
<?php if (!empty($g->topic_id)) {
    echo " → <a href=\"/ax1/set_home_community_topic_post/page/$g->community_id/$g->topic_id/0\">$g->topic_name</a>";
} ?>