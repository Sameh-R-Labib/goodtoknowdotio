<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
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
            <a href="/ax1/delete_a_commodity_record_delete/page/yes" class="choose">Yes</a>
            <a href="/ax1/delete_a_commodity_record_delete/page/no" class="choose">No</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>