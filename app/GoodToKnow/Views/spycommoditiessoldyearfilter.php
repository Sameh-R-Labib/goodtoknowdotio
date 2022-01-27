<?php global $g; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1><?= $g->tax_year ?>'s Commodity (a.k.a. C) Sold Records</h1>
        <hr>
        <?php if (!empty($g->array)): ?>
            <?php $last = count($g->array) - 1; ?>
            <?php foreach ($g->array as $key => $object): ?>
                <h2 class="topofpage"><?= $object->commodity_type ?>&nbsp;Sold <?= $object->time_sold ?></h2>
                <p><b>Time Sold: </b><?= $object->time_sold ?></p>
                <p><b>Time Bought: </b><?= $object->time_bought ?></p>
                <p><b>Price Per C Unit Bought: </b><?= $object->currency_transacted ?>&nbsp;<?= $object->price_bought ?>
                </p>
                <p><b>Price Per C Unit Sold: </b><?= $object->currency_transacted ?>&nbsp;<?= $object->price_sold ?></p>
                <p><b>Amount of C Sold: </b><?= $object->commodity_type ?>&nbsp;<?= $object->commodity_amount ?></p>
                <p><b>Label of C Record From Which C Was Sold: </b><?= $object->commodity_label ?></p>
                <p><b>Tax Year: </b><?= $object->tax_year ?></p>
                <p><b>Net Profit: </b><?= $object->currency_transacted ?>&nbsp;<?= $object->profit ?></p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no Commodity Sold records.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>