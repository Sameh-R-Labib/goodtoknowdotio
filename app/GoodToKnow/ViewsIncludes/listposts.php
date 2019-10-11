<?php if (empty($special_post_array)): ?>
    <em>[No posts in this topic]</em>
<?php endif; ?>
<?php foreach ($special_post_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?= $community_id ?>/<?= $topic_id ?>/<?= $key ?>"><?= $value ?></a>
    </p>
<?php endforeach; ?>