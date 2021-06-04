<?php global $app_state; ?>
<?php if (empty($app_state->special_post_array)): ?>
    <p><em>[No posts in this topic]</em></p>
<?php endif; ?>
<?php foreach ($app_state->special_post_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?= $app_state->community_id ?>/<?= $app_state->topic_id ?>/<?= $key ?>"><?= $value ?></a>
    </p>
<?php endforeach; ?>