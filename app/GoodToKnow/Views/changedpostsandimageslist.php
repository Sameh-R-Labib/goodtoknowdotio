<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Changed Content</h1>
        <?php if (!empty($g->cc_objects)): ?>
            <p>
                <?php foreach ($g->cc_objects as $cc_object): ?>
                    🕒 <b><?= $cc_object->time ?></b> ⏳ <?= $cc_object->expires ?><br>🔍 <?= $cc_object->name ?><br><br>
                <?php endforeach; ?>
            </p>
        <?php else: ?>
            <p>There is no changed content.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>