<?php if ($url_of_most_recent_upload): ?>
    <p>
        <small>
            ▶️ Your Most Recent Uploaded Image URL: [ <?php /** @noinspection PhpUndefinedVariableInspection */
            echo $url_of_most_recent_upload; ?> ] ◀️ ️✂️ + 📋
        </small>
    </p>
<?php else: ?>
    <p>
        <small>
            ▶️ Your Most Recent Uploaded Image URL: [none during this session] ◀️
        </small>
    </p>
<?php endif; ?>