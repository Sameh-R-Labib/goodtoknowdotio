<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/write_over_a_taxable_income_event_year_filter/page" method="post">
        <h1>Edit a Taxable Income Event</h1>
        <?php require SESSIONMESSAGE; ?>
    <p>Which <em>year received</em> does the event fall under?</p>
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