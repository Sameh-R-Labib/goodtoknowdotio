<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Topic Where To Move Post To</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">These are the topics in your current community.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->special_topic_array as $key => $value): ?>
                <a href="/ax1/move_post_get_topic/page/<?= $key ?>" class="choose"><?= $value ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>