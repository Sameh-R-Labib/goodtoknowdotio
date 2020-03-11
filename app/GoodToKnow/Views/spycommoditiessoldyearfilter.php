<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>See 1 Year's Commodities Sold</h1>
        <hr>
        <?php if (!empty($array)): ?>
            <?php $last = count($array) - 1; ?>
            <?php foreach ($array as $key => $object): ?>
                <h2 class="topofpage"><?= $object->time_sold ?></h2>
                <p><b>Time Sold: </b><?= $object->time_sold ?></p>
                <p><b>Time Bought: </b><?= $object->time_bought ?></p>
                <p><b>Price Bought: </b><?= $object->currency_transacted ?>&nbsp;<?= $object->price_bought ?></p>
                <p><b>Price Sold: </b><?= $object->currency_transacted ?>&nbsp;<?= $object->price_sold ?></p>
                <p><b>What Was Sold: </b><?= $object->commodity_type ?>&nbsp;<?= $object->commodity_amount ?></p>
                <p><b>Label of What Was Sold: </b><?= $object->commodity_label ?></p>
                <p><b>Tax Year: </b><?= $object->tax_year ?></p>
                <p><b>Net Profit: </b><?= $object->profit ?></p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no Commodities Sold 📽s.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>