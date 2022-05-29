<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Delete Any Post</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">These are only topics from within the current community.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <p>In which topic?</p>
        <section>
            <?php foreach ($g->special_topic_array as $key => $value): ?>
                <a href="/ax1/quick_post_delete_processor/page/<?= $key ?>" class="choose"> <?= $value ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>