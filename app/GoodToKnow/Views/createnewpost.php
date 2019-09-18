<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/CreateNewPostProcessor/page" method="post">
        <h1>Create a 📄</h1>
        <p>Which topic is for the new post?</p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($special_topic_array as $key => $value): ?>
                <label for="choice-<?php echo $key; ?>" class="radio">
                    <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                    <?= $value ?>
                </label>
            <?php endforeach; ?>
        </section>
        <p><small>* These are topics in the current community.</small></p>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>