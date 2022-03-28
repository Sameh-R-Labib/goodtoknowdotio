<?php global $g; ?>
<?php if (isset($g->special_community_array)): ?>
    <?php foreach ($g->special_community_array as $key => $value): ?>
        <a href="/ax1/set_home_community_topic_post/page/<?= $key ?>/0/0"><?= $value ?></a>&nbsp;&nbsp;
    <?php endforeach; ?>
<?php endif; ?>
