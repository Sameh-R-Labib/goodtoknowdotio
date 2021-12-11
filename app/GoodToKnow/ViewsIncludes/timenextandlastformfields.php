<?php global $g; ?>
<p>Last</p>
<p>
    <label for="last_date"></label>
    <input id="last_date" name="last_date" type="text" required minlength="10" maxlength="14" size="14"
           placeholder="mm/dd/yyyy" value="<?= $g->saved_arr01['last_date'] ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="last_hour"></label>
    <input id="last_hour" name="last_hour" type="text" required minlength="1" maxlength="2" size="3" placeholder="h"
           value="<?= $g->saved_arr01['last_hour'] ?>">
    <label for="last_minute">: </label>
    <input id="last_minute" name="last_minute" type="text" required minlength="1" maxlength="2" size="3" placeholder="m"
           value="<?= $g->saved_arr01['last_minute'] ?>">
    <label for="last_second">: </label>
    <input id="last_second" name="last_second" type="text" required minlength="1" maxlength="2" size="3" placeholder="s"
           value="<?= $g->saved_arr01['last_second'] ?>">
</p>
<p>Next</p>
<p>
    <label for="next_date"></label>
    <input id="next_date" name="next_date" type="text" required minlength="10" maxlength="14" size="14"
           placeholder="mm/dd/yyyy" value="<?= $g->saved_arr01['next_date'] ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="next_hour"></label>
    <input id="next_hour" name="next_hour" type="text" required minlength="1" maxlength="2" size="3" placeholder="h"
           value="<?= $g->saved_arr01['next_hour'] ?>">
    <label for="next_minute">: </label>
    <input id="next_minute" name="next_minute" type="text" required minlength="1" maxlength="2" size="3" placeholder="m"
           value="<?= $g->saved_arr01['next_minute'] ?>">
    <label for="next_second">: </label>
    <input id="next_second" name="next_second" type="text" required minlength="1" maxlength="2" size="3" placeholder="s"
           value="<?= $g->saved_arr01['next_second'] ?>">
    <label for="timezone"></label>
    <input id="timezone" name="timezone" type="text" placeholder="PHP Timezone" required
           minlength="2" maxlength="60" size="18" value="<?= $g->saved_arr01['timezone'] ?>">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>
</p>
