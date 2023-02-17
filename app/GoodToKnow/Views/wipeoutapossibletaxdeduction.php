<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/wipe_out_a_possible_tax_deduction_year_filter/page" method="post">
        <h1>Delete a Tax Deduction</h1>
        <p class="tooltip">ⅈ
            <span class="tooltiptext tooltip-top">Your goal here is to narrow down the data set for 🤔 Tax ✍🏽🔽</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
    <p>Which Year Paid does the transaction fall under?</p>
    <section>
        <p>
            <label for="year_paid">Year Paid: </label>
            <input id="year_paid" name="year_paid" type="text" value="" required minlength="4" maxlength="6"
                   size="6" placeholder="2018">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>