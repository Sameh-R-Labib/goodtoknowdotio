<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Delete a Commodity Sold Record</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Commodity Sold Record?</p>
        <section>
            <?php foreach ($g->array as $object): ?>
                <a href="/ax1/drop_a_commodity_sold_delete/page/<?= $object->id ?>"
                   class="choose"><b><?= $object->commodity_label ?></b>
                    [<?= $object->commodity_type ?> <?= $object->commodity_amount ?>]</a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>