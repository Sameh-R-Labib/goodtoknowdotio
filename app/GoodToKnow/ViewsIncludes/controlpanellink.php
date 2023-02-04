<?php global $g; ?>
<?php if ($g->is_admin): ?>
    <a href="/ax1/admin_home/page"><img src="/more-button-md.png" alt="Admin Panel" height="82" width="82"></a>
<?php elseif ($g->is_guest): ?>
    <img src="/more-button-md.png" alt="Admin Panel" height="82" width="82">
<?php else: ?>
    <a href="/ax1/control_panel/page"><img src="/more-button-md.png" alt="Admin Panel" height="82" width="82"></a>
<?php endif; ?>