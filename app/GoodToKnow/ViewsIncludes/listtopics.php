<?php global $app_state; ?>
<?php if (empty($app_state->special_topic_array)): ?>
    <p><em>[No topics in this community]</em></p>
<?php endif; ?>
<?php foreach ($app_state->special_topic_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?= $app_state->community_id ?>/<?= $key ?>/0"><?= $value ?></a>
    </p>
<?php endforeach; ?>