<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/DeleteABitcoinRecordProcessor/page" method="post">
        <h1>Delete a Commodity Record</h1>
        <p>Which Commodity Record?</p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->array_of_commodity_objects as $key => $commodity_object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $commodity_object->id ?>">
                    <?= $commodity_object->address ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>