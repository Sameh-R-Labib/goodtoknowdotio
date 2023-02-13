<?php global $g; ?>
<?php if ($g->is_guest): ?>
    <p><a href="/ax1/login_form/page"><img src="/loginbwicon.png" alt="Login" height="53" width="53"></a></p>
<?php else: ?>
    <p><a href="/ax1/logout/page"><img src="/logoutbuttonblue.png" alt="Logout" height="31" width="63"></a></p>
<?php endif; ?>