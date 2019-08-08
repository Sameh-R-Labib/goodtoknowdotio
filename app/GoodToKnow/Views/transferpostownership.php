<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/TransferPostOwnershipProcessor/page" method="post">
    <h1>Transfer 📄 Ownership</h1>
    <h2>Transfer Post Ownership</h2>
    <p>You are trying to specify which post to transfer ownership of. Choose the topic where the post resides.</p>
    <?php require SESSIONMESSAGE; ?>
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
