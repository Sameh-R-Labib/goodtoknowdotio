<?php global $g; ?>
<?php if ($g->is_guest): ?>
    <p><a href="/ax1/login_form/page">🔑 log in</a></p>
<?php else: ?>
    <p><a href="/ax1/logout/page">log out</a></p>
<?php endif; ?>