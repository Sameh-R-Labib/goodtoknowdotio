<?php global $app_state; ?>
<?php if (!empty($app_state->post_id)) {
    echo " → <a
    href=\"/ax1/SetHomePageCommunityTopicPost/page/$app_state->community_id/$app_state->topic_id/$app_state->post_id\">
    $app_state->post_name</a>";
} ?>