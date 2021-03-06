<?php global $g; ?>
<p>
    <label for="lastdate">Last: </label>
    <input id="lastdate" name="lastdate" type="text" required minlength="10" maxlength="14" size="14"
           placeholder="mm/dd/yyyy"
           value="<?= $g->last['date'] ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="lasthour"></label>
    <input id="lasthour" name="lasthour" type="text" required minlength="1" maxlength="2" size="3" placeholder="h"
           value="<?= $g->last['hour'] ?>">
    <label for="lastminute">: </label>
    <input id="lastminute" name="lastminute" type="text" required minlength="1" maxlength="2" size="3" placeholder="m"
           value="<?= $g->last['minute'] ?>">
    <label for="lastsecond">: </label>
    <input id="lastsecond" name="lastsecond" type="text" required minlength="1" maxlength="2" size="3" placeholder="s"
           value="<?= $g->last['second'] ?>">
</p>
<p>
    <label for="nextdate">Next: </label>
    <input id="nextdate" name="nextdate" type="text" required minlength="10" maxlength="14" size="14"
           placeholder="mm/dd/yyyy"
           value="<?= $g->next['date'] ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="nexthour"></label>
    <input id="nexthour" name="nexthour" type="text" required minlength="1" maxlength="2" size="3" placeholder="h"
           value="<?= $g->next['hour'] ?>">
    <label for="nextminute">: </label>
    <input id="nextminute" name="nextminute" type="text" required minlength="1" maxlength="2" size="3" placeholder="m"
           value="<?= $g->next['minute'] ?>">
    <label for="nextsecond">: </label>
    <input id="nextsecond" name="nextsecond" type="text" required minlength="1" maxlength="2" size="3" placeholder="s"
           value="<?= $g->next['second'] ?>">
    <label for="timezone"></label>
    <input id="timezone" name="timezone" type="text" placeholder="PHP Timezone" required
           minlength="2" maxlength="60" size="18" value="<?= $g->timezone ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>
</p>
