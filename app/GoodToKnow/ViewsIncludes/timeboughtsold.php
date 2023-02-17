<?php global $g ?>
<hr>
<p>Bought</p>
<p>
    <label for="time_bought_date"></label>
    <input id="time_bought_date" name="time_bought_date" type="text" required minlength="10" maxlength="14" size="14"
           placeholder="mm/dd/yyyy" value="<?= $g->saved_arr01['time_bought_date'] ?>">
    <span class="tooltip">ⅈ<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="time_bought_hour"></label>
    <input id="time_bought_hour" name="time_bought_hour" type="text" required minlength="1" maxlength="2" size="3"
           placeholder="h" value="<?= $g->saved_arr01['time_bought_hour'] ?>">
    <label for="time_bought_minute">: </label>
    <input id="time_bought_minute" name="time_bought_minute" type="text" required minlength="1" maxlength="2" size="3"
           placeholder="m" value="<?= $g->saved_arr01['time_bought_minute'] ?>">
    <label for="time_bought_second">: </label>
    <input id="time_bought_second" name="time_bought_second" type="text" required minlength="1" maxlength="2" size="3"
           placeholder="s" value="<?= $g->saved_arr01['time_bought_second'] ?>">
</p>
<hr>
<p>Sold</p>
<p>
    <label for="time_sold_date"></label>
    <input id="time_sold_date" name="time_sold_date" type="text" required minlength="10" maxlength="14" size="14"
           placeholder="mm/dd/yyyy" value="<?= $g->saved_arr01['time_sold_date'] ?>">
    <span class="tooltip">ⅈ<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="time_sold_hour"></label>
    <input id="time_sold_hour" name="time_sold_hour" type="text" required minlength="1" maxlength="2" size="3"
           placeholder="h" value="<?= $g->saved_arr01['time_sold_hour'] ?>">
    <label for="time_sold_minute">: </label>
    <input id="time_sold_minute" name="time_sold_minute" type="text" required minlength="1" maxlength="2" size="3"
           placeholder="m" value="<?= $g->saved_arr01['time_sold_minute'] ?>">
    <label for="time_sold_second">: </label>
    <input id="time_sold_second" name="time_sold_second" type="text" required minlength="1" maxlength="2" size="3"
           placeholder="s" value="<?= $g->saved_arr01['time_sold_second'] ?>">
    <label for="timezone"></label>
    <input id="timezone" name="timezone" type="text" placeholder="PHP Timezone" required
           minlength="2" maxlength="60" size="18" value="<?= $g->saved_arr01['timezone'] ?>">
    <span class="tooltip">ⅈ<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>
</p>
<hr>
