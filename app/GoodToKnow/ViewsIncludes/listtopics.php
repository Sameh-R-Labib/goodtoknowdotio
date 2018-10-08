<?php

var_dump($special_topic_array);
die('That is special topic array');

foreach ($special_topic_array as $key => $value): ?>
    <p>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?php echo $community_id; ?>/<?php echo $key; ?>/0"><?php echo $value; ?></a>
    </p>
<?php endforeach; ?>