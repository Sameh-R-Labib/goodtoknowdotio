<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Edit a Capital Gain Record</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Capital Gain Record?</p>
        <section>
            <?php foreach ($g->array as $object): ?>
                <a href="/ax1/fine_tune_a_commodity_sold_edit/page/<?= $object->id ?>"
                   class="choose"><b><?= $object->commodity_label ?></b>
                    [<?= $object->commodity_type ?> <?= $object->commodity_amount ?>]</a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>