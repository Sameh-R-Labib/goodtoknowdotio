<?php global $g; ?>
<p>
    <label for="lastdate">Last: </label>
    <input id="lastdate" name="lastdate" type="text" required minlength="10" maxlength="14" size="14"
           placeholder="mm/dd/yyyy"
           value="<?= $_SESSION['saved_arr01']['last']['date'] ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="lasthour"></label>
    <input id="lasthour" name="lasthour" type="text" required minlength="1" maxlength="2" size="3" placeholder="h"
           value="<?= $_SESSION['saved_arr01']['last']['hour'] ?>">
    <label for="lastminute">: </label>
    <input id="lastminute" name="lastminute" type="text" required minlength="1" maxlength="2" size="3" placeholder="m"
           value="<?= $_SESSION['saved_arr01']['last']['minute'] ?>">
    <label for="lastsecond">: </label>
    <input id="lastsecond" name="lastsecond" type="text" required minlength="1" maxlength="2" size="3" placeholder="s"
           value="<?= $_SESSION['saved_arr01']['last']['second'] ?>">
</p>
<p>
    <label for="nextdate">Next: </label>
    <input id="nextdate" name="nextdate" type="text" required minlength="10" maxlength="14" size="14"
           placeholder="mm/dd/yyyy" value="<?= $_SESSION['saved_arr01']['next']['date'] ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="nexthour"></label>
    <input id="nexthour" name="nexthour" type="text" required minlength="1" maxlength="2" size="3" placeholder="h"
           value="<?= $_SESSION['saved_arr01']['next']['hour'] ?>">
    <label for="nextminute">: </label>
    <input id="nextminute" name="nextminute" type="text" required minlength="1" maxlength="2" size="3" placeholder="m"
           value="<?= $_SESSION['saved_arr01']['next']['minute'] ?>">
    <label for="nextsecond">: </label>
    <input id="nextsecond" name="nextsecond" type="text" required minlength="1" maxlength="2" size="3" placeholder="s"
           value="<?= $_SESSION['saved_arr01']['next']['second'] ?>">
    <label for="timezone"></label>
    <input id="timezone" name="timezone" type="text" placeholder="PHP Timezone" required
           minlength="2" maxlength="60" size="18" value="<?= $g->timezone ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>
</p>
