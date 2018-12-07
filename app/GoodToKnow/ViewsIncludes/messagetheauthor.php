<?php if ($show_poof === true || $type_of_resource_requested === 'post'): ?>
    <p><a href="/ax1/MessageTheAuthor/page"><?php echo $author_username; ?></a></p>
<?php else: ?>
    <p>💨</p>
<?php endif; ?>