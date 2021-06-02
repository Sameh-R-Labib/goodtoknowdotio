<?php global $app_state; ?>
<?php if (!empty($app_state->message)): ?>
    <p>👨🏽‍🦱:&nbsp;&nbsp;<?= $app_state->message ?></p>
<?php endif; ?>