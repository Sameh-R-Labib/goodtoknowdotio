<?php global $community_id; ?>
<?php global $topic_id; ?>
<?php global $topic_name; ?>
<?php if (!empty($topic_id)) {
    echo " → <a href=\"/ax1/SetHomePageCommunityTopicPost/page/{$community_id}/{$topic_id}/0\">{$topic_name}</a>";
} ?>