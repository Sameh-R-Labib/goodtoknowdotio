<?php global $g; ?>
<?php if ($g->is_admin): ?>
    <a href="/ax1/AdminHome/page"><img src="/cpicon.png" alt="Admin Panel" height="86" width="108"></a>
<?php elseif ($g->is_guest): ?>
    <img src="/cpicon.png" alt="Admin Panel" height="86" width="108">
<?php else: ?>
    <a href="/ax1/ControlPanel/page"><img src="/cpicon.png" alt="Admin Panel" height="86" width="108"></a>
<?php endif; ?>