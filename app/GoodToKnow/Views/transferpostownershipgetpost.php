<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/TransferPostOwnershipGetUsername/page" method="post">
    <h2>Confirm</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>Are you sure you want me to transfer ownership of "<?= $long_title_of_post; ?>". Which resides in
        the <?= $community_name ?> community. Which resides in the <i><?= $topic_name ?></i> topic. And is currently
        owned by <b><?= $author_username ?></b>.</p>
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
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>
