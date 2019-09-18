<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/EditMyPostEditor/page" method="post">
    <h2>Which post?</h2>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($special_post_array as $key => $value): ?>
            <label for="choice-<?= $key ?>" class="radio">
                <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                <?= $value ?>
            </label>
        <?php endforeach; ?>
    </section>
    <p><small>Note: There`s a limit on <b>size of post</b>.</small></p>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>