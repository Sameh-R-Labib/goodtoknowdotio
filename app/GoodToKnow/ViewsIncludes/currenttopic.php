<?php global $app_state; ?>
<?php global $topic_name; ?>
<?php if (!empty($app_state->topic_id)) {
    echo " → <a href=\"/ax1/SetHomePageCommunityTopicPost/page/$app_state->community_id/$app_state->topic_id/0\">$topic_name</a>";
} ?>