<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/feature_a_task_edit/page" method="post">
        <h1>Edit a Task</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which task?</p>
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