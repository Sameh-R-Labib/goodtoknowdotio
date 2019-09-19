<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/AuthorDeletesOwnPostProcessor/page" method="post">
        <h1>Author Deletes Own 📄 (Post)</h1>
        <p>From which topic?</p>
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
        <p><small>* These are the topics in your <b>current community</b>.</small></p>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>