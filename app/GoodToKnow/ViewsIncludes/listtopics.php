<?php global $gtk; ?>
<?php if (empty($gtk->special_topic_array)): ?>
    <p><em>[No topics in this community]</em></p>
<?php endif; ?>
<?php foreach ($gtk->special_topic_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?= $gtk->community_id ?>/<?= $key ?>/0"><?= $value ?></a>
    </p>
<?php endforeach; ?>