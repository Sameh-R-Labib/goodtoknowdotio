<?php global $gtk; ?>
<?php if ($gtk->is_guest): ?>
    <p><a href="/ax1/LoginForm/page">🔑 log in</a></p>
<?php else: ?>
    <p><a href="/ax1/Logout/page">log out</a></p>
<?php endif; ?>