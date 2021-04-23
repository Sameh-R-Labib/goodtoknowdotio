<?php global $community_id; ?>
<?php global $topic_id; ?>
<?php global $post_name; ?>
<?php if (!empty($post_id)) {
    echo " → <a href=\"/ax1/SetHomePageCommunityTopicPost/page/{$community_id}/{$topic_id}/{$post_id}\">{$post_name}</a>";
} ?>