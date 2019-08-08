<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/QuickPostDeleteProcessor/page" method="post">
        <h2>Delete A Post</h2>
        <?php require SESSIONMESSAGE; ?>
        <p>Topics in current community:</p>
        <p>In which topic?</p>
        <section>
            <?php foreach ($special_topic_array as $key => $value): ?>
                <label for="choice-<?= $key ?>" class="radio">
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