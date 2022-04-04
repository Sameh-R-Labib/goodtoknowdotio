<?php global $g; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Last Payment for a RP</h1>
        <hr>
        <?php if (!empty($g->array_of_recurring_payment_objects)): ?>
            <?php $last = count($g->array_of_recurring_payment_objects) - 1; ?>
            <?php foreach ($g->array_of_recurring_payment_objects as $key => $object): ?>
                <h2 class="topofpage"><?= $object->label ?></h2>
                <p>🕒: <?= $object->time ?> — <b><?= $object->currency ?><?= $object->amount_paid ?></b>
                    — <?= $object->comment ?></p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no recurring payments.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>