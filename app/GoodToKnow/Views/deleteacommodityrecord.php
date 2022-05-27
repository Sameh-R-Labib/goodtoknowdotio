<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Delete a Commodity Record</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->array_of_commodity_objects as $commodity_object): ?>
                <a href="/ax1/delete_a_commodity_record_processor/page/<?= $commodity_object->id ?>"
                   class="choose"><b><?= $commodity_object->address ?></b>
                    <?= $commodity_object->commodity ?> <?= $commodity_object->current_balance ?> —
                    <?= $commodity_object->time ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>