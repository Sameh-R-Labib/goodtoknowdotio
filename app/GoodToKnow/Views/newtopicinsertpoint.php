<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/NewTopicIPProcessor/page" method="post">
    <h2>Where to put the new topic?</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>This assumes you're adding a new topic to the current community. To add a topic to a different community
        you need to switch to it first.</p>
    <section>
        <label for="relate" class="dropdown">Put it
            <select id="relate" name="relate">
                <option value="after">after</option>
                <option value="before">before</option>
            </select>
        </label>
    </section>
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