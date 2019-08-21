<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>See all To-do Tasks/💪s</h1>
        <hr>
        <?php if (!empty($array)): ?>
            <?php $last = count($array) - 1; ?>
            <?php foreach ($array as $key => $object): ?>
                <h2 class="topofpage"><?= $object->label ?></h2>
                <p><b>Last 🕒: </b><?= $object->last ?></p>
                <p><b>Next 🕒: </b><?= $object->next ?></p>
                <p><b>Cycle Type: </b><?= $object->cycle_type ?></p>
                <p><?= $object->comment ?></p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no to-do tasks.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>