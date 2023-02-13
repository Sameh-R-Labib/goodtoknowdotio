<?php global $g; ?>
<?php if ($g->is_guest): ?>
    <p><a href="/ax1/login_form/page">🔑 log in</a></p>
<?php else: ?>
    <p><a href="/ax1/logout/page"><img src="/logoutbuttonblue.png" alt="Admin Panel" height="48" width="100"></a></p>
<?php endif; ?>