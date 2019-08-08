<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <?php if (!empty($array)): ?>
            <?php $last = count($array) - 1; ?>
            <?php foreach ($array as $key => $object): ?>
                <h2 class="topofpage"><?= $object->label ?></h2>
                <p><b>Year Paid: </b><?= $object->year_paid ?></p>
                <p><?= $object->comment ?></p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no possible tax deductions.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>