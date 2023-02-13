<?php global $g; ?>
<?php if ($g->is_admin): ?>
    <p><a href="/ax1/broadcast_msg/page"><img src="/message_users.ico" alt="message all users" height="28"
                                              width="28"></a></p>
<?php elseif ($g->is_guest): ?>
    <p>✊🤬😭&#x2192;☭Ⓐ</p>
<?php else: ?>
    <p><a href="/ax1/write_to_admin/page">💬 <img src="/anon_admin.png" alt="message admin" height="28" width="28"></a>
    </p>
<?php endif; ?>