<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/EditMyPostProcessor/page" method="post">
        <h2>Which topic?</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">Shown above are the topics within your current community.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->special_topic_array as $key => $value): ?>
                <label for="choice-<?= $key ?>" class="radio">
                    <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                    <?= $value ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>