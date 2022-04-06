<?php global $g; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1><?= $g->tax_year ?>'s Commodity <small>(a.k.a. C)</small> Sold Records</h1>
        <hr>
        <?php if (!empty($g->array)): ?>
            <?php $last = count($g->array) - 1; ?>
            <?php foreach ($g->array as $key => $object): ?>
                <h2 class="topofpage"><?= $object->commodity_type ?>&nbsp;Sold <?= $object->time_sold ?></h2>
                <p>Time Sold: <?= $object->time_sold ?><br>
                    Time Bought: <?= $object->time_bought ?><br>
                    Price Per C Unit Bought: <?= $object->currency_transacted ?>
                    &nbsp;<?= $object->price_bought ?><br>
                    Price Per C Unit Sold: <?= $object->currency_transacted ?>&nbsp;<?= $object->price_sold ?>
                    <br>
                    Amount of C Sold: <?= $object->commodity_type ?>&nbsp;<?= $object->commodity_amount ?><br>
                    Label of C Record From Which C Was Sold: <?= $object->commodity_label ?><br>
                    Tax Year: <?= $object->tax_year ?><br>
                    Net Profit: <?= $object->currency_transacted ?>
                    <?php if ($object->profit < 0): ?>
                        🔥(
                    <?php endif; ?>
                    <?= $object->profit ?>
                    <?php if ($object->profit < 0): ?>
                        )🔥
                    <?php endif; ?>
                </p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no commodity_sold records.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>