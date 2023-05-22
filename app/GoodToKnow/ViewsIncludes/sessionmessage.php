<?php global $g; ?>
<?php if (!empty($g->message)): ?>
    <p>
        <button class="open-window-button">🪟</button>
        ≬
        👨🏽‍🦱:&nbsp;&nbsp;<?= $g->message ?>
    </p>
<?php endif; ?>