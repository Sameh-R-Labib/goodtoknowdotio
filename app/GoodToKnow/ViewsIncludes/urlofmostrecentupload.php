<?php if ($url_of_most_recent_upload): ?>
    <small>
        ▶️ Recent Upload: [ <?= $url_of_most_recent_upload ?> ] ◀️ ️✂️ + 📋
    </small>
<?php else: ?>
    <small>
        ▶️ Recent Upload: [ none this session ]
    </small>
<?php endif; ?>