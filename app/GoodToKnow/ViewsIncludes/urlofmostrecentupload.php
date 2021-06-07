<?php global $g; ?>
<?php if ($g->url_of_most_recent_upload): ?>
    <small>
        ▶️&nbsp;Recent Upload: [ <?= $g->url_of_most_recent_upload ?> ] ◀️ ️✂️ + 📋
    </small>
<?php else: ?>
    <small>
        ▶️&nbsp;Recent Upload: [ none this session ]
    </small>
<?php endif; ?>