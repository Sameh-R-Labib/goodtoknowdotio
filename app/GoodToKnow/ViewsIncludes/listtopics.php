<?php global $g; ?>
<?php if (empty($g->special_topic_array)): ?>
    <p><em>[No topics in this community]</em></p>
<?php endif; ?>
<?php foreach ($g->special_topic_array as $key => $value): ?>
    <div class="inner-block inner-block-higher">
        <a href="/ax1/set_home_community_topic_post/page/<?= $g->community_id ?>/<?= $key ?>/0"><?= $value ?></a>
    </div>
<?php endforeach; ?>
