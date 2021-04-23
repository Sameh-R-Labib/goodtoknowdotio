<?php global $url_of_most_recent_upload; ?>
<?php if ($url_of_most_recent_upload): ?>
    <small>
        ▶️&nbsp;Recent Upload: [ <?= $url_of_most_recent_upload ?> ] ◀️ ️✂️ + 📋
    </small>
<?php else: ?>
    <small>
        ▶️&nbsp;Recent Upload: [ none this session ]
    </small>
<?php endif; ?>