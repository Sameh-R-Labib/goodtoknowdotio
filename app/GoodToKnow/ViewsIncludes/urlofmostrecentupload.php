<?php if ($url_of_most_recent_upload): ?>
    <p>
        <small>
            ▶️ Recent Upload: [ <?php /** @noinspection PhpUndefinedVariableInspection */
            echo $url_of_most_recent_upload; ?> ] ◀️ ️✂️ + 📋
        </small>
    </p>
<?php else: ?>
    <p>
        <small>
            ▶️ Recent Upload: [ none this session ] ◀️
        </small>
    </p>
<?php endif; ?>