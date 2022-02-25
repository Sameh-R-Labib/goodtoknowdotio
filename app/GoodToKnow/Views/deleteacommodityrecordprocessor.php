<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/DeleteACommodityRecordDelete/page" method="post">
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Time of purchase: </b><?= $g->commodity_object->time ?></p>
        <p><b>Address / Label: </b><?= $g->commodity_object->address ?></p>
        <p><b>Commodity Type: </b><?= $g->commodity_object->commodity ?></p>
        <p><b>Price of 1 <?= $g->commodity_object->commodity ?> at 🕒 of
                purchase: </b><?= $g->commodity_object->currency ?>
            &nbsp;<?= $g->commodity_object->price_point ?>
        </p>
        <p><b>Initial Balance: </b><?= $g->commodity_object->commodity ?>
            &nbsp;<?= $g->commodity_object->initial_balance ?></p>
        <p><b>Current Balance: </b><?= $g->commodity_object->commodity ?>
            &nbsp;<?= $g->commodity_object->current_balance ?></p>
        <p><?= $g->commodity_object->comment ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want me to delete "<?= $g->commodity_object->address ?>".</p>
        <section>
            <label for="yes" class="radio">
                <input type="radio" id="yes" name="choice" value="yes">
                Yes<br>
            </label>
            <label for="no" class="radio">
                <input type="radio" id="no" name="choice" value="no">
                No
            </label>
        </section>
        <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>