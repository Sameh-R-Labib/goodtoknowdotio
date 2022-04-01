<?php global $g; ?>
<?php if ($g->show_poof != true && $g->type_of_resource_requested === 'post'): ?>
    <div id="sendtoauthor"><p><a href="/ax1/message_the_author/page"><?= $g->author_username ?></a></p></div>
<?php else: ?>
    <div id="show_poof"><p>💨</p></div>
<?php endif; ?>