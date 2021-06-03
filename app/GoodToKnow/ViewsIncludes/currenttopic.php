<?php global $app_state; ?>
<?php if (!empty($app_state->topic_id)) {
    echo " → <a href=\"/ax1/SetHomePageCommunityTopicPost/page/$app_state->community_id/$app_state->topic_id/0\">$app_state->topic_name</a>";
} ?>