<hr>
<p>Last</p>
<p>
    <label for="lastdate">Date Last (mm/dd/yyyy): </label>
    <input id="lastdate" name="lastdate" type="text" required minlength="10" maxlength="14" size="14"
           spellcheck="false" placeholder="06/21/2009" value="<?= $last['date'] ?>">
</p>
<p>
    <label for="lasthour">Hour Last (range 0-23): </label>
    <input id="lasthour" name="lasthour" type="text" required minlength="1" maxlength="2" size="2"
           spellcheck="false" placeholder="14" value="<?= $last['hour'] ?>">
</p>
<p>
    <label for="lastminute">Minute Last (range 0-59): </label>
    <input id="lastminute" name="lastminute" type="text" required minlength="1" maxlength="2" size="2"
           spellcheck="false" placeholder="27" value="<?= $last['minute'] ?>">
</p>
<p>
    <label for="lastsecond">Second Last (range 0-59): </label>
    <input id="lastsecond" name="lastsecond" type="text" required minlength="1" maxlength="2" size="2"
           spellcheck="false" placeholder="52" value="<?= $last['second'] ?>">
</p>
<hr>
<p>Next</p>
<p>
    <label for="nextdate">Date Next (mm/dd/yyyy): </label>
    <input id="nextdate" name="nextdate" type="text" required minlength="10" maxlength="14" size="14"
           spellcheck="false" placeholder="06/21/2009" value="<?= $next['date'] ?>">
</p>
<p>
    <label for="nexthour">Hour Next (range 0-23): </label>
    <input id="nexthour" name="nexthour" type="text" required minlength="1" maxlength="2" size="2"
           spellcheck="false" placeholder="14" value="<?= $next['hour'] ?>">
</p>
<p>
    <label for="nextminute">Minute Next (range 0-59): </label>
    <input id="nextminute" name="nextminute" type="text" required minlength="1" maxlength="2" size="2"
           spellcheck="false" placeholder="27" value="<?= $next['minute'] ?>">
</p>
<p>
    <label for="nextsecond">Second Next (range 0-59): </label>
    <input id="nextsecond" name="nextsecond" type="text" required minlength="1" maxlength="2" size="2"
           spellcheck="false" placeholder="52" value="<?= $next['second'] ?>">
</p>
<p>
    <label for="timezone">PHP Time Zone <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>️:
    </label>
    <input id="timezone" name="timezone" type="text" placeholder="America/New_York" value="" required
           minlength="2" maxlength="60" size="18" value="<?php echo date_default_timezone_get(); ?>">
</p>
<hr>
