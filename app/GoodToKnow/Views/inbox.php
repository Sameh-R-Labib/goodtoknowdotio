<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <?php if (!empty($inbox_messages_array)): ?>
            <?php $last = count($inbox_messages_array) - 1; ?>
            <?php foreach ($inbox_messages_array as $key => $message): ?>
                <p><b>Time: </b><?php echo $message->created; ?></p>
                <p><b>Sender: </b><?php echo $message->user_id; ?></p>
                <p>&nbsp;</p>
                <?= $message->content ?>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No messages.</p>
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