<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/set_system_wide_alert_proc/page" method="post">
        <h1><?= $g->html_title ?></h1>
        <?php require SESSIONMESSAGE; ?>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">The alert system makes it possible for Admin to make announcements.</span>
        </p>
        <p>Currently, name is <b><?= $g->current_alert_name ?></b>.</p>
        <section>
            <p>name:
                <label for="system_alert" class="radio">
                    <input type="radio" id="system_alert" name="choice" value="system_alert" checked>
                    system_alert<br>
                </label>
                <label for="no_alert" class="radio">
                    <input type="radio" id="no_alert" name="choice" value="no_alert">
                    no_alert
                </label>
            </p>
            <p>
                <label for="message">message:<br></label>
                <input id="message" name="message" type="text" value="" required
                       placeholder="Could be: none"
                       minlength="4" maxlength="230" size="67" spellcheck="true">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>