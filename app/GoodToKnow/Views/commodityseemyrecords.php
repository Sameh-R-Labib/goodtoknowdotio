<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
<?php global $g; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Commodity Records</h1>
        <hr>
        <?php if (!empty($g->array_of_commodity_objects)): ?>
            <?php $numItems = count($g->array_of_commodity_objects); ?>
            <?php $i = 0; ?>
            <?php foreach ($g->array_of_commodity_objects as $key => $commodity): ?>
                <p><b>Time of purchase: </b><?= $commodity->time ?></p>
                <p><b>Address: </b><?= $commodity->address ?></p>
                <p><b>Price of 1<?= $commodity->commodity ?> at 🕒 of purchase: </b><?= $commodity->currency ?>
                    &nbsp;<?= $commodity->price_point ?>
                </p>
                <p><b>Initial Balance: </b><?= $commodity->commodity ?>&nbsp;<?= $commodity->initial_balance ?></p>
                <p><b>Current Balance: </b><?= $commodity->commodity ?>&nbsp;<?= $commodity->current_balance ?></p>
                <p><?= $commodity->comment ?></p>
                <?php if (++$i !== $numItems): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No Commodity records.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>