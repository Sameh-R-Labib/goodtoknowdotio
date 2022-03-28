<?php global $g; ?>
<?php if (!empty($g->post_id)) {
    echo " → <a
    href=\"/ax1/set_home_community_topic_post/page/$g->community_id/$g->topic_id/$g->post_id\">
    $g->post_name</a>";
} ?>