<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/TopicDescriptionEditorProcessor/page" method="post">
    <h2>Topic Description Editor</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>These are topics in the current community.</p>
    <p>Which topic is the one whose description it is that you want to edit?</p>
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