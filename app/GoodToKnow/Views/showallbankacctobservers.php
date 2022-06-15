<?php global $g; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Bank Account Observers You Own</h1>
        <hr>
        <?php if (!empty($g->array_of_objects)): ?>
            <?php $last = count($g->array_of_objects) - 1; ?>
            <?php foreach ($g->array_of_objects as $key => $object): ?>
                <h2 class="topofpage"><?= $object->account_id ?></h2>
                <p>
                    <b>The User Observing The Bank Account: </b><?= $object->observer_id ?>
                </p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You do not own any bank account observers.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>