<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <?php if (!empty($readable_user_objects_array)): ?>
            <?php $last = count($readable_user_objects_array) - 1; ?>
            <?php foreach ($readable_user_objects_array as $key => $user): ?>
                <p>&nbsp;</p>
                <p><b>U/N:&nbsp;&nbsp;</b><?= $user->username ?></p>
                <p><b>Default Community:&nbsp;&nbsp;</b><?= $user->readable_community_name ?></p>
                <p><b>Title:&nbsp;&nbsp;</b><?= $user->title ?></p>
                <p><b>Role:&nbsp;&nbsp;</b><?= $user->readable_role ?></p>
                <p><b>Race:&nbsp;&nbsp;</b><?= $user->readable_race ?></p>
                <p><b>Is-Suspended:&nbsp;&nbsp;</b><?= $user->readable_is_suspended ?></p>
                <p><b>Date:&nbsp;&nbsp;</b><?= $user->date ?></p>
                <p>&nbsp;</p>
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
    <!-- footerbar -->
    <div id="footerbar">
        <p align="center" style="font-size: 1em;">
            <img src="/Gnu-head-30-years-anniversary.svg" style="float:left;height: 32px;width: 32px;margin-top: -6px">
            © 2018 - Sameh Ramzy Labib
            <img src="/2000px-GPLv3_Logo.svg.png"
                 height="32" width="70"
                 style="float:right;;margin-top: -6px"></p>
    </div>
<?php require BOTTOMOFPAGES; ?>