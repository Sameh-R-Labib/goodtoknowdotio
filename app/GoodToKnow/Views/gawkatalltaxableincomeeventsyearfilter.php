<?php global $g; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>See 1 Year's Taxable 💸 Events</h1>
        <hr>
        <?php if (!empty($g->array)): ?>
            <?php $last = count($g->array) - 1; ?>
            <?php foreach ($g->array as $key => $object): ?>
                <h2 class="topofpage"><?= $object->label ?></h2>
                <p><b>Year when Received: </b><?= $object->year_received ?></p>
                <p><b>Time when Received: </b><?= $object->time ?></p>
                <p><?= $object->currency ?>&nbsp;<?= $object->amount ?></p>
                <p><?= $object->comment ?></p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no taxable income events.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>