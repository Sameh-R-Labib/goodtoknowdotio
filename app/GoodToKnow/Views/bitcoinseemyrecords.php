<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>See all ₿ 📽s</h1>
        <hr>
        <?php if (!empty($array_of_bitcoin_objects)): ?>
            <?php $last = count($array_of_bitcoin_objects) - 1; ?>
            <?php foreach ($array_of_bitcoin_objects as $key => $bitcoin): ?>
                <p><b>Time of purchase: </b><?php echo $bitcoin->unix_time_at_purchase; ?></p>
                <p><b>Address: </b><?= $bitcoin->address ?></p>
                <p><b>Price of 1₿ at 🕒 of purchase: </b>$&nbsp;<?= $bitcoin->price_point ?></p>
                <p><b>Initial Balance: </b>₿&nbsp;<?= $bitcoin->initial_balance ?></p>
                <p><b>Current Balance: </b>₿&nbsp;<?= $bitcoin->current_balance ?></p>
                <p>&nbsp;</p>
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