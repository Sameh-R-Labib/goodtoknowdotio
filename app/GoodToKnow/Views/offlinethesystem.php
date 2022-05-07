<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/offline_the_system_proc/page" method="post">
        <h1><?= $g->html_title ?></h1>
        <?php require SESSIONMESSAGE; ?>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">An offline Gtk.io only permits Admin to be logged in and active.</span>
        </p>
        <p>The current system status is: <b><?= $g->current_status ?></b>.<br>
            Do you want me to toggle the system status?</p>
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