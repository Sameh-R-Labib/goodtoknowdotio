<?php global $g; ?>
<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>User Roster</h1>
        <hr>
        <?php if (!empty($g->readable_user_objects_array)): ?>
            <?php $last = count($g->readable_user_objects_array) - 1; ?>
            <?php foreach ($g->readable_user_objects_array as $key => $user): ?>
                <p>&nbsp;</p>
                <p><b>U/N:&nbsp;&nbsp;</b><?= $user->username ?></p>
                <p><b>Default Community:&nbsp;&nbsp;</b><?= $user->readable_community_name ?></p>
                <p><b>Title:&nbsp;&nbsp;</b><?= $user->title ?></p>
                <p><b>Role:&nbsp;&nbsp;</b><?= $user->readable_role ?></p>
                <p><b>Race:&nbsp;&nbsp;</b><?= $user->readable_race ?></p>
                <p><b>Is-Suspended:&nbsp;&nbsp;</b><?= $user->readable_is_suspended ?></p>
                <p><b>Date:&nbsp;&nbsp;</b><?= $user->date ?></p>
                <p><b>Comment:&nbsp;&nbsp;</b><?= $user->comment ?></p>
                <p>&nbsp;</p>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No users found in the system.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>