<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/QuickPostDeleteProcessor/page" method="post">
        <h1>Delete Any 📄</h1>
        <h2>Delete A Post</h2>
        <p>Topics in current community:</p>
        <p>In which topic?</p>
        <?php require SESSIONMESSAGE; ?>
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