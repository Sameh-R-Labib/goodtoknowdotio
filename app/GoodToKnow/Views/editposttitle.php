<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h2>Which topic?</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">Shown below are the topics within your current community.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->special_topic_array as $key => $value): ?>
                <a href="/ax1/edit_post_title_processor/page/<?= $key ?>"
                   class="choose"><?= $value ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>