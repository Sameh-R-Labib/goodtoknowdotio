<?php global $g; ?>
<?php if ($g->is_admin): ?>
    <p><a href="/ax1/broadcast_msg/page"><img src="/message_users.ico" alt="message all users" height="30"
                                              width="30"></a></p>
<?php elseif ($g->is_guest): ?>
    <p>✊🤬😭&#x2192;☭Ⓐ</p>
<?php else: ?>
    <p><a href="/ax1/write_to_admin/page">💬 Admin</a></p>
<?php endif; ?>