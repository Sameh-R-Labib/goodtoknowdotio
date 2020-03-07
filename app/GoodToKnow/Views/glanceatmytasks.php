<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Tasks</h1>
        <?php if (!empty($array)): ?>
            <?php foreach ($array as $key => $object): ?>
                <h2 class="topofpage"><?= $object->label ?></h2>
                <p><?= $object->next ?></p>
                <p><?= $object->cycle_type ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no to-do tasks.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>