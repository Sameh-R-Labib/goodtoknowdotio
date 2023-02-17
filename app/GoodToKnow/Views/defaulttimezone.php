<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/default_time_zone_processor/page" method="post">
        <h1>Change my Default ⌚🌐</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>New default timezone</p>
        <section>
            <p>
                <label for="timezone">PHP Time Zone <span class="tooltip">ⅈ<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>️:
                </label>
                <input id="timezone" name="timezone" type="text" placeholder="America/New_York" value="" required
                       minlength="2" maxlength="60" size="18">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>