<?php global $g; ?>
<?php if ($g->is_admin): ?>
    <p><a href="/ax1/broadcast_msg/page">message all users</a></p>
<?php elseif ($g->is_guest): ?>
    <p>✊🤬😭&#x2192;☭Ⓐ</p>
<?php else: ?>
    <p><a href="/ax1/write_to_admin/page">💬 👔 admin</a></p>
<?php endif; ?>