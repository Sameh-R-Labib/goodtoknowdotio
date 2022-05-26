<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Confirm</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Are you sure you want me to delete "<b><?= $g->long_title_of_post ?></b>".</p>
        <section>
            <a href="/ax1/author_deletes_own_post_del_proc/page/yes" class="choose">Yes</a>
            <a href="/ax1/author_deletes_own_post_del_proc/page/no" class="choose">No</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>