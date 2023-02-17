<?php global $g; ?>
<p>️
    <label for="date"></label>
    <input id="date" name="date" type="text" required minlength="10" maxlength="14" size="14" placeholder="mm/dd/yyyy"
           value="<?= $g->saved_arr01['date'] ?>">
    <span class="tooltip">ⅈ<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="hour"></label>
    <input id="hour" name="hour" type="text" required minlength="1" maxlength="2" size="3" placeholder="h"
           value="<?= $g->saved_arr01['hour'] ?>">
    <label for="minute">: </label>
    <input id="minute" name="minute" type="text" required minlength="1" maxlength="2" size="3" placeholder="m"
           value="<?= $g->saved_arr01['minute'] ?>">
    <label for="second">: </label>
    <input id="second" name="second" type="text" required minlength="1" maxlength="2" size="3" placeholder="s"
           value="<?= $g->saved_arr01['second'] ?>">
    <label for="timezone"></label>
    <input id="timezone" name="timezone" type="text" placeholder="PHP Timezone" required
           minlength="2" maxlength="60" size="18" value="<?= $g->saved_arr01['timezone'] ?>">
    <span class="tooltip">ⅈ<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>
</p>
