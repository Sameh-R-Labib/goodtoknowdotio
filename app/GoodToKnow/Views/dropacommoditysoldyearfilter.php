<?php global $array; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/DropACommoditySoldDelete/page" method="post">
        <h1>Delete a Commodity Sold 📽</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Commodity Sold?</p>
        <section>
            <?php foreach ($array as $key => $object): ?>
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