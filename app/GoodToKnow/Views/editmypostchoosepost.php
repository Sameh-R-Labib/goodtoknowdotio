<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/EditMyPostEditor/page" method="post">
        <h2>Which post?</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">⚠️ there`s a limit on size of posts.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->special_post_array as $key => $value): ?>
                <label for="choice-<?= $key ?>" class="radio">
                    <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                    <?= $value ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>