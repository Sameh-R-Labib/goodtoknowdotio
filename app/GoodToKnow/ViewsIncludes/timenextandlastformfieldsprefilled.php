<hr>
<p>
    <label for="lastdate">Last: </label>
    <input id="lastdate" name="lastdate" type="text" required minlength="10" maxlength="14" size="14"
           placeholder="mm/dd/yyyy"
           value="<?= $last['date'] ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="lasthour"></label>
    <input id="lasthour" name="lasthour" type="text" required minlength="1" maxlength="2" size="2" placeholder="hr"
           value="<?= $last['hour'] ?>">
    <label for="lastminute">: </label>
    <input id="lastminute" name="lastminute" type="text" required minlength="1" maxlength="2" size="2" placeholder="mn"
           value="<?= $last['minute'] ?>">
    <label for="lastsecond">: </label>
    <input id="lastsecond" name="lastsecond" type="text" required minlength="1" maxlength="2" size="2" placeholder="sd"
           value="<?= $last['second'] ?>">
</p>
<hr>
<p>
    <label for="nextdate">Next: </label>
    <input id="nextdate" name="nextdate" type="text" required minlength="10" maxlength="14" size="14"
           placeholder="mm/dd/yyyy"
           value="<?= $next['date'] ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="nexthour"></label>
    <input id="nexthour" name="nexthour" type="text" required minlength="1" maxlength="2" size="2" placeholder="hr"
           value="<?= $next['hour'] ?>">
    <label for="nextminute">: </label>
    <input id="nextminute" name="nextminute" type="text" required minlength="1" maxlength="2" size="2" placeholder="mn"
           value="<?= $next['minute'] ?>">
    <label for="nextsecond">: </label>
    <input id="nextsecond" name="nextsecond" type="text" required minlength="1" maxlength="2" size="2" placeholder="sd"
           value="<?= $next['second'] ?>">
    <label for="timezone"></label>
    <input id="timezone" name="timezone" type="text" placeholder="PHP Timezone" required
           minlength="2" maxlength="60" size="18" value="<?= $timezone ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>
</p>
<hr>
