<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form>
    <h1>Confirm</h1>
    <?php require SESSIONMESSAGE; ?>
    <p>Are you sure you want me to transfer ownership of "<?= $g->long_title_of_post; ?>". Which resides in
        the <?= $g->community_name ?> community. Which resides in the <i><?= $g->topic_name ?></i>
        topic. And is currently owned by <b><?= $g->author_username ?></b>.</p>
    <section>
        <a href="/ax1/transfer_post_ownership_get_username/page/yes" class="choose">Yes</a>
        <a href="/ax1/transfer_post_ownership_get_username/page/no" class="choose">No</a>
    </section>
    <?php require ABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
