<?php global $g; ?>
<?php if (!empty($g->message)): ?>
    <p>
        <button class="resize-button">Resize Window</button>
        👨🏽‍🦱:&nbsp;&nbsp;<?= $g->message ?></p>
<?php endif; ?>