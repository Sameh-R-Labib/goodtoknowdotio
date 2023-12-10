<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/spy_commodities_sold_year_filter/page" method="post">
        <h1>See a Year's Capital Gain Records</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which tax year?</p>
        <section>
            <p>
                <label for="tax_year">Tax Year: </label>
                <input id="tax_year" name="tax_year" type="text" value="" required minlength="4" maxlength="6"
                       size="6" placeholder="2018">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>