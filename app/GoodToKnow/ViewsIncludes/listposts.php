<?php foreach ($special_post_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?php echo $community_id; ?>/<?php echo $topic_id; ?>/<?php echo $key; ?>"><?php echo $value; ?></a>
    </p>
<?php endforeach; ?>