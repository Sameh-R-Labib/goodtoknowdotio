<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1><?= $g->html_title ?></h1>
        <?php require SESSIONMESSAGE; ?>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">An offline Gtk.io only permits Admin to be logged in and active.</span>
        </p>
        <p>The current system status is: <b><?= $g->current_status ?></b>.<br>
            Do you want me to toggle the system status?</p>
        <section>
            <a href="/ax1/offline_the_system_proc/page/yes" class="choose">Yes</a>
            <a href="/ax1/offline_the_system_proc/page/no" class="choose">No</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>