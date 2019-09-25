<p>
    <label for="date">Date (mm/dd/yyyy): </label>
    <input id="date" name="date" type="text" required minlength="10" maxlength="14" size="14"
           spellcheck="false" placeholder="06/21/2009">
</p>
<p>
    <label for="hour">Hour (range 0-23): </label>
    <input id="hour" name="hour" type="text" required minlength="1" maxlength="2" size="2"
           spellcheck="false" placeholder="14">
</p>
<p>
    <label for="minute">Minute (range 0-59): </label>
    <input id="minute" name="minute" type="text" required minlength="1" maxlength="2" size="2"
           spellcheck="false" placeholder="27">
</p>
<p>
    <label for="second">Second (range 0-59): </label>
    <input id="second" name="second" type="text" required minlength="1" maxlength="2" size="2"
           spellcheck="false" placeholder="52">
</p>
<p>
    <label for="timezone">PHP Time Zone <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>️:
    </label>
    <input id="timezone" name="timezone" type="text" placeholder="America/New_York" value="" required
           minlength="2" maxlength="60" size="18">
</p>
