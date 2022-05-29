<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h2>Which post?</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">⚠️ there`s a limit on size of posts.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->special_post_array as $key => $value): ?>
                <a href="/ax1/edit_post_title_editor/page/<?= $key ?>" class="choose"><?= $value ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>