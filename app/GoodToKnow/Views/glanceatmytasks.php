<?php global $g; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>All My Tasks</h1>
        <?php if (!empty($g->array)): ?>
            <?php foreach ($g->array as $key => $object): ?>
                <p><a class="cross" href="/ax1/FeatureATaskLink/page">✎ Edit</a>
                    <em><?= $object->label ?></em> ◜ <?= $object->next ?> ⇁ <?= $object->cycle_type ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There are no to-do tasks.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>