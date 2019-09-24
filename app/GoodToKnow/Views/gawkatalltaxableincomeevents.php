<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/GawkAtAllTaxableIncomeEventsYearFilter/page" method="post">
    <h1>See a year's Taxable 💸 Event 📽s</h1>
    <p>Which year_received are you inquiring about?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="year_received">Year received: </label>
            <input id="year_received" name="year_received" type="text" value="" required minlength="4" maxlength="6"
                   size="6" placeholder="2018">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>