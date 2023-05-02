<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Changed Content</h1>
        <?php if (!empty($g->cc_objects)): ?>
            <p>
                <?php foreach ($g->cc_objects as $cc_object): ?>
                    🕒 <?= $cc_object->time ?> ⏳ <?= $cc_object->expires ?> 🔍 <?= $cc_object->name ?><br>
                <?php endforeach; ?>
            </p>
        <?php else: ?>
            <p>There is no changed content.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>