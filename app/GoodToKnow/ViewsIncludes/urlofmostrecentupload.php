<?php global $app_state; ?>
<?php if ($app_state->url_of_most_recent_upload): ?>
    <small>
        ▶️&nbsp;Recent Upload: [ <?= $app_state->url_of_most_recent_upload ?> ] ◀️ ️✂️ + 📋
    </small>
<?php else: ?>
    <small>
        ▶️&nbsp;Recent Upload: [ none this session ]
    </small>
<?php endif; ?>