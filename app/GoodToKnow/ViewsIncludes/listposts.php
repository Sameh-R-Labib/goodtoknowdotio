<?php global $g; ?>
<?php if (empty($g->special_post_array)): ?>
    <p><em>[No posts in this topic]</em></p>
<?php endif; ?>
<?php foreach ($g->special_post_array as $key => $value): ?>
    <a href="/ax1/set_home_community_topic_post/page/<?= $g->community_id ?>/<?= $g->topic_id ?>/<?= $key ?>">
        <div class="inner-block">
            <?= $value ?>
        </div>
    </a>
<?php endforeach; ?>
