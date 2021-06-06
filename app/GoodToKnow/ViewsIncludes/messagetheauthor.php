<?php global $gtk; ?>
<?php if ($gtk->show_poof != true && $gtk->type_of_resource_requested === 'post'): ?>
    <div id="sendtoauthor"><p><a href="/ax1/MessageTheAuthor/page"><?= $gtk->author_username ?></a></p></div>
<?php else: ?>
    <div id="show_poof"><p>💨</p></div>
<?php endif; ?>