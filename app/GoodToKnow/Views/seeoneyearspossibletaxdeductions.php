<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/SeeOneYearsPossibleTaxDeductionsYearFilter/page" method="post">
        <h1>See 1 year's Tax ✍🏽 Offs</h1>
        <?php require SESSIONMESSAGE; ?>
    <p>Which year_paid are you inquiring about?</p>
    <section>
        <p>
            <label for="year_paid">Year for year_paid: </label>
            <input id="year_paid" name="year_paid" type="text" value="" required minlength="4" maxlength="6"
                   size="6" placeholder="2018">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>