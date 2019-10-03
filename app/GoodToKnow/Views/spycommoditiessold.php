<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/SpyCommoditiesSoldYearFilter/page" method="post">
        <h1>See a year's Commodities Sold 📽s</h1>
        <p>Which tax year?</p>
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