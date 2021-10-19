<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/ForgetATaskProcessor/page" method="post">
        <h1>Delete a Task</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Task?</p>
        <section>
            <?php foreach ($g->array as $key => $object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <?= $object->label ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>