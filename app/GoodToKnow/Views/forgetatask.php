<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/ForgetATaskProcessor/page" method="post">
    <h1>Delete a To-do Task/💪</h1>
    <h2>Which Task?</h2>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($array as $key => $object): ?>
            <label for="c<?php echo $key; ?>" class="radio">
                <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                <?= $object->label ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>