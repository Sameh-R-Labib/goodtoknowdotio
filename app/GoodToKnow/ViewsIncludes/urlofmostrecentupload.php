<?php global $gtk; ?>
<?php if ($gtk->url_of_most_recent_upload): ?>
    <small>
        ▶️&nbsp;Recent Upload: [ <?= $gtk->url_of_most_recent_upload ?> ] ◀️ ️✂️ + 📋
    </small>
<?php else: ?>
    <small>
        ▶️&nbsp;Recent Upload: [ none this session ]
    </small>
<?php endif; ?>