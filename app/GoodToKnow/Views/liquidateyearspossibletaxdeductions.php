<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/LiquidateYearsPossibleTaxDeductionsGetYear/page" method="post">
    <h1>Admin delete a year's 🤔 Tax ✍🏽🔽s</h1>
    <h2>No Warning before Delete</h2>
    <p>If today's year is 2019 then do not delete 2019, 2018, 2017 or 2016 because that is what our users' are
        promised. <b>*No warning will be given or safety measure will be applied if you supply the wrong year.*</b></p>
    <p>Which year_paid's records do you want to delete?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="year_paid">Year these expenditure were paid: </label>
            <input id="year_paid" name="year_paid" type="text" value="" required minlength="4" maxlength="6"
                   size="6" placeholder="2018">
        </p>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>