<?php global $show_poof; ?>
<?php global $is_guest; ?>
<?php global $type_of_resource_requested; ?>
<?php global $author_username; ?>
<?php if ($show_poof != true && $type_of_resource_requested === 'post'): ?>
    <div id="sendtoauthor"><p><a href="/ax1/MessageTheAuthor/page"><?= $author_username ?></a></p></div>
<?php else: ?>
    <div id="show_poof"><p>💨</p></div>
<?php endif; ?>