<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/WipeOutAPossibleTaxDeductionYearFilter/page" method="post">
    <h1>Delete a 🤔 Tax ✍🏽🔽</h1>
    <h2>To narrow down the data set for 🤔 Tax ✍🏽🔽</h2>
    <p>Which Year Paid does the transaction fall under?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="year_paid">Year Paid: </label>
            <input id="year_paid" name="year_paid" type="text" value="" required minlength="4" maxlength="6"
                   size="6" placeholder="2018">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>