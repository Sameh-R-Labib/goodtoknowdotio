<?php global $g; ?>
<?php if ($g->is_guest): ?>
    <p><a class="purplebtn" href="/ax1/login_form/page">Login/a></p>
<?php else: ?>
    <p><a class="orangebtn" href="/ax1/logout/page">Logout</a></p>
<?php endif; ?>