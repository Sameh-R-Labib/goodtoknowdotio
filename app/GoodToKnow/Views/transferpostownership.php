<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/TransferPostOwnershipProcessor/page" method="post">
    <h1>Transfer 📄 Ownership</h1>
    <p class="tooltip">ℹ️
        <span class="tooltiptext tooltip-top">Your goal here is to specify which post to transfer ownership of.</span>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <p>Choose the topic where the post resides.</p>
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
