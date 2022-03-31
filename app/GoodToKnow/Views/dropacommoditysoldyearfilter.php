<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/drop_a_commodity_sold_delete/page" method="post">
        <h1>Delete a Commodity Sold Record</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Commodity Sold Record?</p>
        <section>
            <?php foreach ($g->array as $key => $object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <b><?= $object->commodity_label ?></b>
                    [<?= $object->commodity_type ?> <?= $object->commodity_amount ?>]<br>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>