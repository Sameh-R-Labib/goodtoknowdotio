<?php require TOPFORFORMPAGES; ?>
<?php global $g; ?>
    <form action="/ax1/EditACommodityRecordProcessor/page" method="post">
        <h1>Edit a Commodity Record</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>⭐ <b>Suggestion:</b> Deleting useless records will unclutter this page and reduce our burden.</p>
        <section>
            <?php foreach ($g->array_of_commodity_objects as $key => $commodity_object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $commodity_object->id ?>">
                    <b><?= $commodity_object->address ?></b>
                    <?= $commodity_object->commodity ?> <?= $commodity_object->current_balance ?> —
                    <?= $commodity_object->time ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>