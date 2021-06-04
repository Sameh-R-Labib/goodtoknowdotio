<?php global $app_state; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/NewTopicIPProcessor/page" method="post">
        <h1>Insertion Point</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">This assumes you're adding a new topic to the current community. To add a
            topic to a different community you need to switch to it first.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <p>Where to put the new topic?</p>
        <section>
            <label for="relate" class="dropdown">Put it
                <select id="relate" name="relate">
                    <option value="after">after</option>
                    <option value="before">before</option>
                </select>
            </label>
        </section>
        <section>
            <?php foreach ($app_state->special_topic_array as $key => $value): ?>
                <label for="choice-<?= $key ?>" class="radio">
                    <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                    <?= $value ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>