<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/set_system_wide_alert_proc/page" method="post">
        <h1><?= $g->html_title ?></h1>
        <?php require SESSIONMESSAGE; ?>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">The alert system makes it possible for Admin to make announcements.</span>
        </p>
        <p>The current alert name is: <b><?= $g->current_alert_name ?></b>.<br>
            Here, you can modify the database alert record.</p>
        <section>

        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>