<?php if ($is_admin): ?>
    <p><a href="/ax1/BroadcastMsg/page">🌏🌎🌍👲 users</a></p>
<?php elseif (isset($is_guest) && $is_guest): ?>
    <p>✊☭Ⓐ🤬</p>
<?php else: ?>
    <p><a href="/ax1/WriteToAdmin/page">♠👔♠ admin</a></p>
<?php endif; ?>