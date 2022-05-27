<?php require TOPFORFORMPAGES; ?>
<?php global $g; ?>
    <form>
        <h1>Edit a Commodity Record</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>⭐ <b>Suggestion:</b> Deleting useless records will unclutter this page and reduce our burden.</p>
        <section>
            <?php foreach ($g->array_of_commodity_objects as $key => $commodity_object): ?>
                <a href="/ax1/edit_a_commodity_record_processor/page/<?= $commodity_object->id ?>"
                   class="choose"><b><?= $commodity_object->address ?></b>
                    <?= $commodity_object->commodity ?> <?= $commodity_object->current_balance ?> —
                    <?= $commodity_object->time ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>