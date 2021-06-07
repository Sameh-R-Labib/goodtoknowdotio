<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/TransferPostOwnershipGetUsername/page" method="post">
    <h1>Confirm</h1>
    <?php require SESSIONMESSAGE; ?>
    <p>Are you sure you want me to transfer ownership of "<?= $g->long_title_of_post; ?>". Which resides in
        the <?= $g->community_name ?> community. Which resides in the <i><?= $g->topic_name ?></i>
        topic. And is
        currently
        owned by <b><?= $g->author_username ?></b>.</p>
    <section>
        <label for="yes" class="radio">
            <input type="radio" id="yes" name="choice" value="yes">
            Yes<br>
        </label>
        <label for="no" class="radio">
            <input type="radio" id="no" name="choice" value="no">
            No
        </label>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
