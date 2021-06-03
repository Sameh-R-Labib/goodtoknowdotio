<?php global $app_state; ?>
<?php if (isset($app_state->special_community_array)): ?>
    <?php foreach ($app_state->special_community_array as $key => $value): ?>
        <a href="/ax1/SetHomePageCommunityTopicPost/page/<?php echo $key; ?>/0/0"><?php echo $value; ?></a>&nbsp;&nbsp;
    <?php endforeach; ?>
<?php endif; ?>
