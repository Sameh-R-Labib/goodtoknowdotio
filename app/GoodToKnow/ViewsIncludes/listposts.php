<?php global $gtk; ?>
<?php if (empty($gtk->special_post_array)): ?>
    <p><em>[No posts in this topic]</em></p>
<?php endif; ?>
<?php foreach ($gtk->special_post_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?= $gtk->community_id ?>/<?= $gtk->topic_id ?>/<?= $key ?>"><?= $value ?></a>
    </p>
<?php endforeach; ?>