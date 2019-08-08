<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/WriteOverATaxableIncomeEventYearFilter/page" method="post">
    <h1>Edit a Taxable 💸 Event 📽</h1>
    <h2>Narrow down the data set for Taxable 💸 Event 📽</h2>
    <p>Which year_received does the event fall under?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="year_received">Year received: </label>
            <input id="year_received" name="year_received" type="text" value="" required minlength="4" maxlength="6"
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