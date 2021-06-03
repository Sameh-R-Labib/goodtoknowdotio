<?php global $app_state; ?>
<?php global $topic_id; ?>
<?php global $special_post_array; ?>
<?php if (empty($special_post_array)): ?>
    <p><em>[No posts in this topic]</em></p>
<?php endif; ?>
<?php foreach ($special_post_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?= $app_state->community_id ?>/<?= $topic_id ?>/<?= $key ?>"><?= $value ?></a>
    </p>
<?php endforeach; ?>