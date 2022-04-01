<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/liquidate_years_possible_tax_deductions_get_year/page" method="post">
        <h1>Admin delete a year's 🤔 Tax ✍🏽🔽s</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">❌ No Warning before Delete. If today's year is 2019 then do not delete 2019,
            2018, 2017 or 2016 because that is what our users' are promised.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
    <p>Which year_paid's records do you want to delete?</p>
    <section>
        <p>
            <label for="year_paid">Year these expenditure were paid: </label>
            <input id="year_paid" name="year_paid" type="text" value="" required minlength="4" maxlength="6"
                   size="6" placeholder="2018">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>