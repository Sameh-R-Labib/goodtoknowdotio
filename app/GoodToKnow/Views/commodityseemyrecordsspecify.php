<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/CommoditySeeMyRecords/page" method="post">
        <h1>Specify Parameters</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>I want to know which Commodity records you want to see.</p>
        <section>
            <p>
                <label for="commodity_symbol">Commodity: </label>
                <input id="commodity_symbol" name="commodity_symbol" type="text" value="" required minlength="1"
                       maxlength="15" size="15" placeholder="OXT">
            </p>
            <p>Begin</p>
            <p>
                <label for="begin_date"></label>
                <input id="begin_date" name="begin_date" type="text" required minlength="10" maxlength="14" size="14"
                       placeholder="mm/dd/yyyy" value="">
                <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
                <label for="begin_hour"></label>
                <input id="begin_hour" name="begin_hour" type="text" required minlength="1" maxlength="2" size="3"
                       placeholder="h" value="">
                <label for="begin_minute">: </label>
                <input id="begin_minute" name="begin_minute" type="text" required minlength="1" maxlength="2" size="3"
                       placeholder="m" value="">
                <label for="begin_second">: </label>
                <input id="begin_second" name="begin_second" type="text" required minlength="1" maxlength="2" size="3"
                       placeholder="s" value="">
            </p>
            <p>End</p>
            <p>
                <label for="end_date"></label>
                <input id="end_date" name="end_date" type="text" required minlength="10" maxlength="14" size="14"
                       placeholder="mm/dd/yyyy" value="">
                <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">hr is military hour (0-23)</span></span>
                <label for="end_hour"></label>
                <input id="end_hour" name="end_hour" type="text" required minlength="1" maxlength="2" size="3"
                       placeholder="h" value="">
                <label for="end_minute">: </label>
                <input id="end_minute" name="end_minute" type="text" required minlength="1" maxlength="2" size="3"
                       placeholder="m" value="">
                <label for="end_second">: </label>
                <input id="end_second" name="end_second" type="text" required minlength="1" maxlength="2" size="3"
                       placeholder="s" value="">
                <label for="timezone"></label>
                <input id="timezone" name="timezone" type="text" placeholder="PHP Timezone" required
                       minlength="2" maxlength="60" size="18" value="<?= $g->timezone ?>">
                <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>