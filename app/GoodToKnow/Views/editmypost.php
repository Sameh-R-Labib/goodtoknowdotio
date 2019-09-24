<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/EditMyPostProcessor/page" method="post">
    <h1>Edit My 📄</h1>
    <p class="tooltip">ℹ️
        <span class="tooltiptext tooltip-top">Shown above are the topics within your current community.</span>
    </p>
    <p>Choose the <em>topic</em> where your post lives.</p>
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