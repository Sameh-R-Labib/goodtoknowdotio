<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/CreateNewPostProcessor/page" method="post">
        <h1>Create a 📄</h1>
        <p>Which <em>topic</em> do you want the new <em>post</em> to live in?</p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($special_topic_array as $key => $value): ?>
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