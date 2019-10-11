<?php if (empty($special_post_array)): ?>
    <p><em>[No posts in this topic]</em></p>
<?php endif; ?>
<?php foreach ($special_post_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?= $community_id ?>/<?= $topic_id ?>/<?= $key ?>"><?= $value ?></a>
    </p>
<?php endforeach; ?>