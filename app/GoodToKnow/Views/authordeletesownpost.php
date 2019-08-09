<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/AuthorDeletesOwnPostProcessor/page" method="post">
    <h1>Author Deletes Own 📄</h1>
    <h2>Author Deletes Own Post</h2>
    <p>Topics in current community:</p>
    <p>In which topic?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($special_topic_array as $key => $value): ?>
            <label for="choice-<?php echo $key; ?>" class="radio">
                <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                <?= $value ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>