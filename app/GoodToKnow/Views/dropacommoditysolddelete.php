<?php global $object; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/DropACommoditySoldConfirmation/page" method="post">
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>&nbsp;</p>
        <p><b>Time Sold: </b><?php echo $object->time_sold; ?></p>
        <p><b>Time Bought: </b><?= $object->time_bought ?></p>
        <p><b>Price Bought: </b><?= $object->currency_transacted ?>&nbsp;<?= $object->price_bought ?></p>
        <p><b>Price Sold: </b><?= $object->currency_transacted ?>&nbsp;<?= $object->price_sold ?></p>
        <p><b>What Was Sold: </b><?= $object->commodity_type ?>&nbsp;<?= $object->commodity_amount ?></p>
        <p><b>Label of What Was Sold: </b><?= $object->commodity_label ?></p>
        <p><b>Tax Year: </b><?= $object->tax_year ?></p>
        <p><b>Net Profit: </b><?= $object->profit ?></p>
        <p>&nbsp;</p>
        <p>Are you sure you want to delete this?</p>
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