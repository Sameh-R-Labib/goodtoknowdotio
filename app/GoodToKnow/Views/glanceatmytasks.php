<?php global $gtk; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>All My Tasks</h1>
        <?php if (!empty($gtk->array)): ?>
            <?php foreach ($gtk->array as $key => $object): ?>
                <p>⇀ <em><?= $object->label ?></em> ◜ <?= $object->next ?> ⇁ <?= $object->cycle_type ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no to-do tasks.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>