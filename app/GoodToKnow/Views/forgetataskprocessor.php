<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Label: </b><?= $g->object->label ?></p>
        <p><b>Last 🕒: </b><?= $g->object->last ?></p>
        <p><b>Next 🕒: </b><?= $g->object->next ?></p>
        <p><b>Cycle Type: </b><?= $g->object->cycle_type ?></p>
        <p><?= $g->object->comment ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want to delete this?</p>
        <section>
            <a href="/ax1/forget_a_task_delete/page/yes" class="choose">Yes</a>
            <a href="/ax1/forget_a_task_delete/page/no" class="choose">No</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>