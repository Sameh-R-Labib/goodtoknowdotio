<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/drop_a_commodity_sold_year_filter/page" method="post">
        <h1>Delete a Commodity Sold Record</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">Here the <em>tax year</em> is defined as the year you sold the commodity.</span>
        </p>
        <p>Which <em>tax year</em>?</p>
        <?php require SESSIONMESSAGE; ?>
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