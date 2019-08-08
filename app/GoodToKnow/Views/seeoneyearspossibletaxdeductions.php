<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/SeeOneYearsPossibleTaxDeductionsYearFilter/page" method="post">
    <h1>See a year's 🤔 Tax ✍🏽🔽s</h1>
    <h2>Narrow down the data set for 🤔 Tax ✍🏽🔽s</h2>
    <p>Which year_paid are you inquiring about?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="year_paid">Year for year_paid: </label>
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