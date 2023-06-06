<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Changed Content</h1>
        <p class="tooltip">ⅈ
            <span class="tooltiptext tooltip-top">Posts have incorrect community after following their link.</span>
        </p>
        <p><b><u>List</u></b></p>
        <?php if (!empty($g->cc_objects)): ?>
            <p>
                <?php foreach ($g->cc_objects as $cc_object): ?>
                    🕒 <b><?= $cc_object->time ?></b> ⏳ <?= $cc_object->expires ?> 🙍 <?= $cc_object->author_username ?>
                    <br>
                    <?php if ($cc_object->type == 'blog_post'): ?>
                        <a href="/ax1/set_home_community_topic_post/page/<?= $cc_object->community_id ?>/<?= $cc_object->topic_id ?>/<?= $cc_object->post_id ?>">
                            🔍 <?= $cc_object->name ?>
                        </a>
                    <?php else: ?>
                        🔍 <?= $cc_object->name ?>
                    <?php endif; ?>
                    <br><br>
                <?php endforeach; ?>
            </p>
        <?php else: ?>
            <p>There is no changed content.</p>
        <?php endif; ?>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>