<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/EditMyPostEditor/page" method="post">
    <h2>Which post do you want to edit?</h2>
    <p>* The size of post has an upper limit.</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($special_post_array as $key => $value): ?>
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