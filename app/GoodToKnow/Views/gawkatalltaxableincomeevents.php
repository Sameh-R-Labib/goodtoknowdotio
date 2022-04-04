<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/gawk_at_all_taxable_income_events_year_filter/page" method="post">
        <h1>See a Year's Taxable Income Events</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which year received?</p>
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