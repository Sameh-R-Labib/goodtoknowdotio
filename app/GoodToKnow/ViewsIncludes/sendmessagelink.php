<?php if ($is_admin): ?>
    <p><a href="/ax1/BroadcastMsg/page">message all users</a></p>
<?php elseif ($is_guest): ?>
    <p>✊🤬😭&#x2192;☭Ⓐ</p>
<?php else: ?>
    <p><a href="/ax1/WriteToAdmin/page">💬 👔 admin</a></p>
<?php endif; ?>