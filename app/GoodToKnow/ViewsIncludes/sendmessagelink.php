<?php global $g; ?>
<?php if ($g->is_admin): ?>
    <p><a href="/ax1/broadcast_msg/page"><img src="/img/message_users.ico" alt="message all users" height="28"
                                              width="28"></a></p>
<?php elseif ($g->is_guest): ?>
    <p><img src="/img/victory_hand_gesture.png" alt="united we stand" height="26" width="36"></p>
<?php else: ?>
    <p><a href="/ax1/write_to_admin/page"><img src="/img/anon_admin.png" alt="message admin" height="26" width="26"></a>
    </p>
<?php endif; ?>