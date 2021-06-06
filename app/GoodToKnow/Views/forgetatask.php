<?php global $gtk; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/ForgetATaskProcessor/page" method="post">
        <h1>Delete a Task</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Task?</p>
        <section>
            <?php foreach ($gtk->array as $key => $object): ?>
                <label for="c<?php echo $key; ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <?= $object->label ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>