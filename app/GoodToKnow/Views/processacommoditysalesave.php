<?php global $g; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Evidence It Was Saved</h1>
        <?php foreach ($g->commodity_from_db as $key => $commodity): ?>
            <h2>#<?= $key ?> Commodity</h2>
            <p><b>Time of purchase: </b><?= $commodity->time ?><br>
                <b>Address / Label: </b><?= $commodity->address ?><br>
                <b>Price of 1<?= $commodity->commodity ?> at 🕒 of purchase: </b><?= $commodity->currency ?>
                &nbsp;<?= $commodity->price_point ?><br>
                <b>Initial Balance: </b><?= $commodity->commodity ?>&nbsp;<?= $commodity->initial_balance ?><br>
                <b>Current Balance: </b><?= $commodity->commodity ?>&nbsp;<?= $commodity->current_balance ?><br>
                <?= $commodity->comment ?></p>
            <h2>#<?= $key ?> Commodity Sold</h2>
            <p>Time Sold: <?= $g->commodity_sold_from_db[$key]->time_sold ?><br>
                Time Bought: <?= $g->commodity_sold_from_db[$key]->time_bought ?><br>
                Price Per C Unit Bought: <?= $g->commodity_sold_from_db[$key]->currency_transacted ?>
                <?= $g->commodity_sold_from_db[$key]->price_bought ?><br>
                Price Per C Unit Sold: <?= $g->commodity_sold_from_db[$key]->currency_transacted ?>
                <?= $g->commodity_sold_from_db[$key]->price_sold ?>
                <br>
                Amount of C Sold: <?= $g->commodity_sold_from_db[$key]->commodity_type ?>
                <?= $g->commodity_sold_from_db[$key]->commodity_amount ?>
                <br>
                Label of C Record From Which C Was Sold: <?= $g->commodity_sold_from_db[$key]->commodity_label ?><br>
                Net Profit: <?= $g->commodity_sold_from_db[$key]->currency_transacted ?>
                <?php if ($g->commodity_sold_from_db[$key]->profit < 0): ?>
                    🔥(
                <?php endif; ?>
                <?= $g->commodity_sold_from_db[$key]->profit ?>
                <?php if ($g->commodity_sold_from_db[$key]->profit < 0): ?>
                    )🔥
                <?php endif; ?>
            </p>
        <?php endforeach; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>