<?php global $app_state; ?>
<?php global $topic_id; ?>
<?php global $post_name; ?>
<?php global $post_id; ?>
<?php if (!empty($post_id)) {
    echo " → <a href=\"/ax1/SetHomePageCommunityTopicPost/page/{$app_state->community_id}/{$topic_id}/{$post_id}\">{$post_name}</a>";
} ?>