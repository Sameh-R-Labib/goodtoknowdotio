<?php foreach ($special_post_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?= $community_id ?>/<?= $topic_id ?>/<?= $key ?>"><?= $value ?></a>
    </p>
<?php endforeach; ?>