<?php global $special_topic_array; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/TopicDescriptionEditorProcessor/page" method="post">
        <h1>Topic Description Editor</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">This is only for topics in current community</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <p>Which topic is the one whose description it is that you want to edit?</p>
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