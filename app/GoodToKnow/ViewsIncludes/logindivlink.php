<?php global $g; ?>
<?php if ($g->is_guest): ?>
    <p><a href="/ax1/login_form/page"><img src="/img/loginbwicon.png" alt="Login" height="18" width="18"></a></p>
<?php else: ?>
    <p><a class="orangebtn" href="/ax1/logout/page">Logout</a></p>
<?php endif; ?>