<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/see_one_years_possible_tax_deductions_year_filter/page" method="post">
        <h1>See 1 tax year's possible tax deductions</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="year_paid">Year: </label>
                <input id="year_paid" name="year_paid" type="text" value="" required minlength="4" maxlength="6"
                       size="6" placeholder="2018">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>