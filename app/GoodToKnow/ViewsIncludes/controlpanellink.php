<?php global $app_state; ?>
<?php global $is_guest; ?>
<?php if ($app_state->is_admin): ?>
    <a href="/ax1/AdminHome/page"><img src="/cpicon.png" alt="Admin Panel" height="86" width="108"></a>
<?php elseif ($is_guest): ?>
    <img src="/cpicon.png" alt="Admin Panel" height="86" width="108">
<?php else: ?>
    <a href="/ax1/ControlPanel/page"><img src="/cpicon.png" alt="Admin Panel" height="86" width="108"></a>
<?php endif; ?>