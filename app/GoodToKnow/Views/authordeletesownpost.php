<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/AuthorDeletesOwnPostProcessor/page" method="post">
        <h1>Author Deletes Own Blog Post</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">These are the topics in your current community.</span>
        </p>
        <p>From which topic?</p>
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