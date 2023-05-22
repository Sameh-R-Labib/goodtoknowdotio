<?php global $g; ?>
<?php if (!empty($g->message)): ?>
    <p>
        <button class="open-window-button">Open New Window</button>
        👨🏽‍🦱:&nbsp;&nbsp;<?= $g->message ?></p>
<?php endif; ?>