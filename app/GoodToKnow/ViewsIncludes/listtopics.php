<?php global $g; ?>
<?php if (empty($g->special_topic_array)): ?>
    <p><em>[No topics in this community]</em></p>
<?php endif; ?>
<?php foreach ($g->special_topic_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?= $g->community_id ?>/<?= $key ?>/0"><?= $value ?></a>
    </p>
<?php endforeach; ?>