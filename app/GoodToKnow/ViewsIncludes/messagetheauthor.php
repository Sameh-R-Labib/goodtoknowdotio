<?php global $app_state; ?>
<?php global $show_poof; ?>
<?php if ($show_poof != true && $app_state->type_of_resource_requested === 'post'): ?>
    <div id="sendtoauthor"><p><a href="/ax1/MessageTheAuthor/page"><?= $app_state->author_username ?></a></p></div>
<?php else: ?>
    <div id="show_poof"><p>💨</p></div>
<?php endif; ?>