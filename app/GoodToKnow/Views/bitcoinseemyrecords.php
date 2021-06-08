<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
<?php global $g; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Show ₿ 📽s</h1>
        <hr>
        <?php if (!empty($g->array_of_bitcoin_objects)): ?>
            <?php $last = count($g->array_of_bitcoin_objects) - 1; ?>
            <?php foreach ($g->array_of_bitcoin_objects as $key => $bitcoin): ?>
                <p><b>Time of purchase: </b><?php echo $bitcoin->time; ?></p>
                <p><b>Address: </b><?= $bitcoin->address ?></p>
                <p><b>Price of 1₿ at 🕒 of purchase: </b><?= $bitcoin->currency ?>&nbsp;<?= $bitcoin->price_point ?></p>
                <p><b>Initial Balance: </b>₿&nbsp;<?= $bitcoin->initial_balance ?></p>
                <p><b>Current Balance: </b>₿&nbsp;<?= $bitcoin->current_balance ?></p>
                <p><?= $bitcoin->comment ?></p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No Bitcoin records.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>