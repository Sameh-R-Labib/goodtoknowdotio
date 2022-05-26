<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Time Sold: </b><?= $g->object->time_sold ?></p>
        <p><b>Time Bought: </b><?= $g->object->time_bought ?></p>
        <p><b>Price Bought: </b><?= $g->object->currency_transacted ?>&nbsp;<?= $g->object->price_bought ?></p>
        <p><b>Price Sold: </b><?= $g->object->currency_transacted ?>&nbsp;<?= $g->object->price_sold ?></p>
        <p><b>What Was Sold: </b><?= $g->object->commodity_type ?>&nbsp;<?= $g->object->commodity_amount ?></p>
        <p><b>Label of What Was Sold: </b><?= $g->object->commodity_label ?></p>
        <p><b>Tax Year: </b><?= $g->object->tax_year ?></p>
        <p><b>Net Profit: </b><?= $g->object->profit ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want to delete this?</p>
        <section>
            <a href="/ax1/drop_a_commodity_sold_confirmation/page/yes" class="choose">Yes</a>
            <a href="/ax1/drop_a_commodity_sold_confirmation/page/no" class="choose">No</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>