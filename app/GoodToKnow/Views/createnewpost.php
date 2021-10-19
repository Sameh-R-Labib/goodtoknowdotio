<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/CreateNewPostProcessor/page" method="post">
        <h1>Create a 📄</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">These are the topics in your current community.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <p>Which <em>topic</em> do you want the new <em>post</em> to live in?</p>
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