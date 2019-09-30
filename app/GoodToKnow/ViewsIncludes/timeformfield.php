<p>️
    <label for="date"></label>
    <input id="date" name="date" type="text" required minlength="10" maxlength="14" size="14" placeholder="mm/dd/yyyy">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
    <label for="hour"></label>
    <input id="hour" name="hour" type="text" required minlength="1" maxlength="2" size="2" placeholder="hr">
    <label for="minute">: </label>
    <input id="minute" name="minute" type="text" required minlength="1" maxlength="2" size="2" placeholder="mn">
    <label for="second">: </label>
    <input id="second" name="second" type="text" required minlength="1" maxlength="2" size="2" placeholder="sd">
    <label for="timezone"></label>
    <input id="timezone" name="timezone" type="text" placeholder="PHP Timezone" value="" required
           minlength="2" maxlength="60" size="18">
    <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>
</p>
