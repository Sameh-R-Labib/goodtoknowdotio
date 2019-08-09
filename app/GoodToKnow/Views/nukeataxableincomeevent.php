<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/NukeATaxableIncomeEventYearFilter/page" method="post">
    <h1>Delete a Taxable 💸 Event 📽</h1>
    <h2>To narrow down the data set for Taxable Income Event 📽s</h2>
    <p>Which Year Received does the event fall under?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="year_received">Year Received: </label>
            <input id="year_received" name="year_received" type="text" value="" required minlength="4" maxlength="6"
                   size="6" placeholder="2018">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>