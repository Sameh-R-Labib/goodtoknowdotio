<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/FeatureATaskEdit/page" method="post">
    <h1>Edit a To-do Task/💪</h1>
    <p>Which Task?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($array as $key => $object): ?>
            <label for="c<?= $key ?>" class="radio">
                <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                <?= $object->label ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>