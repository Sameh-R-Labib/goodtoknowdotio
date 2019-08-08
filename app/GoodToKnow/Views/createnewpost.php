<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/CreateNewPostProcessor/page" method="post">
    <h1>Create 📄</h1>
    <h2>Create New Post</h2>
    <p>These are topics in the current community.</p>
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
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>