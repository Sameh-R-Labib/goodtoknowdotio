<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/abolish_years_commodities_sold_get_year/page" method="post">
        <h1>Admin delete a year's Commodity Sold Records</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">If today's year is 2019 then do not delete 2019, 2018, 2017, 2016
                2015, 2014, or 2013 because that is what our users' are promised. ❌ No warning will be given or safety
                measure will be applied if you supply the wrong year.</span>
        </p>
        <p></p>
        <p>Which year's records do you want to delete?</p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="tax_year">Year: </label>
                <input id="tax_year" name="tax_year" type="text" value="" required minlength="4" maxlength="6"
                       size="6" placeholder="2018">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>