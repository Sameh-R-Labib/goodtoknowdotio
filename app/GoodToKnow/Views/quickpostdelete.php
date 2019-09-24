<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/QuickPostDeleteProcessor/page" method="post">
        <h1>Delete Any 📄</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">These are only topics from within the current community.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <p>In which topic?</p>
        <section>
            <?php foreach ($special_topic_array as $key => $value): ?>
                <label for="choice-<?= $key ?>" class="radio">
                    <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                    <?= $value ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>