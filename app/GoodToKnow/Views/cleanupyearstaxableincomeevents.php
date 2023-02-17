<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/cleanup_years_taxable_income_events_get_year/page" method="post">
        <h1>Admin delete a year's Taxable Income Event Records</h1>
        <p class="tooltip">ⅈ
            <span class="tooltiptext tooltip-top">If today's year is 2019 then do not delete 2019, 2018, 2017 or 2016 because that is what our users' are
        promised. ❌ No warning will be given or safety measure will be applied if you supply the wrong year.</span>
        </p>
        <p></p>
        <?php require SESSIONMESSAGE; ?>
        <p>Which year_received's records do you want to delete?</p>
        <section>
            <p>
                <label for="year_received">Year these incomes ware received: </label>
                <input id="year_received" name="year_received" type="text" value="" required minlength="4" maxlength="6"
                       size="6" placeholder="2018">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>