<?php global $g; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Bank Accounts</h1>
        <hr>
        <?php if (!empty($g->array_of_objects)): ?>
            <?php $last = count($g->array_of_objects) - 1; ?>
            <?php foreach ($g->array_of_objects as $key => $object): ?>
                <h2 class="topofpage"><?= $object->acct_name ?></h2>
                <p><b>Start Time: </b><?= $object->start_time ?></p>
                <p><b>Start Amount: </b><?= $object->currency ?>&nbsp;<?= $object->start_balance ?></p>
                <p><?= $object->comment ?></p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no bank accounts.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>