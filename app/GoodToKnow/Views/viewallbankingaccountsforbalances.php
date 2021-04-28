<?php global $array_of_objects; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Bank Accounts</h1>
        <hr>
        <?php if (!empty($array_of_objects)): ?>
            <?php $last = count($array_of_objects) - 1; ?>
            <?php foreach ($array_of_objects as $key => $object): ?>
                <h2 class="topofpage"><?= $object->acct_name ?></h2>
                <p><b>Start 🕒: </b><?= $object->start_time ?></p>
                <p><b>Start ⚖️: </b><?= $object->currency ?>&nbsp;<?= $object->start_balance ?></p>
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