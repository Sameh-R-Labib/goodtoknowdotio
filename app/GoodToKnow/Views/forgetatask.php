<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Delete a Task</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which task?</p>
        <section>
            <?php foreach ($g->array as $object): ?>
                <a href="/ax1/forget_a_task_processor/page/<?= $object->id ?>" class="choose"><?= $object->label ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>