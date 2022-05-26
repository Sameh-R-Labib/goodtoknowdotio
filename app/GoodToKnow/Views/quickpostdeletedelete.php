<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form>
    <h1>Confirm</h1>
    <?php require SESSIONMESSAGE; ?>
    <p>Are you sure you want me to delete "<?= $g->long_title_of_post ?>".</p>
    <section>
        <a href="/ax1/quick_post_delete_del_proc/page/yes" class="choose">Yes</a>
        <a href="/ax1/quick_post_delete_del_proc/page/no" class="choose">No</a>
    </section>
    <?php require ABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
