<?php if (empty($special_topic_array)): ?>
    <em>[No topics in this community]</em>
<?php endif; ?>
<?php foreach ($special_topic_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?= $community_id ?>/<?= $key ?>/0"><?= $value ?></a>
    </p>
<?php endforeach; ?>