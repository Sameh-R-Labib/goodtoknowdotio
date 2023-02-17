<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Topic Description Editor</h1>
        <p class="tooltip">ⅈ
            <span class="tooltiptext tooltip-top">This is only for topics in current community</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <p>Which topic is the one that you want to edit?</p>
        <section>
            <?php foreach ($g->special_topic_array as $key => $value): ?>
                <a href="/ax1/topic_description_editor_processor/page/<?= $key ?>" class="choose">
                    <?= $value ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>