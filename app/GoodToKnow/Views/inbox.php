<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
<?php global $g; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Inbox</h1>
        <hr>
        <?php if (!empty($g->inbox_messages_array)): ?>
            <?php $last = count($g->inbox_messages_array) - 1; ?>
            <?php foreach ($g->inbox_messages_array as $key => $message): ?>
                <p><b>Time: </b><?= $message->created ?>&nbsp;&nbsp;&nbsp;<b>Sender: </b><?= $message->user_id ?>
                    <br><br></p>
                <?= $message->content ?>
                <?php if ($key != $last): ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No messages.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>