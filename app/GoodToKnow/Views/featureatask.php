<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Edit a Task</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which task?</p>
        <section>
            <?php foreach ($g->array as $object): ?>
                <a href="/ax1/feature_a_task_edit/page/<?= $object->id ?>" class="choose"><?= $object->label ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>