<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>⌨️ 🛠 🦺 🎙</h1>
        <?php if (!empty($array)): ?>
            <?php foreach ($array as $key => $object): ?>
                <h2 class="topofpage"><?= $object->label ?></h2>
                <p><b>Next: </b><?= $object->next ?></p>
                <p><b>Cycle Type: </b><?= $object->cycle_type ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no to-do tasks.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>