<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/AlterAPossibleTaxDeductionYearFilter/page" method="post">
        <h1>Edit a Tax ✍🏽 Off</h1>
        <p>Which <em>year paid</em> does the transaction fall under?</p>
        <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="year_paid">Year paid: </label>
            <input id="year_paid" name="year_paid" type="text" value="" required minlength="4" maxlength="6"
                   size="6" placeholder="2018">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>