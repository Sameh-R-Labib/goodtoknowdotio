<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/process_a_commodity_sale_form_processor/page" method="post">
        <h1>Process A Commodity Sale</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Process A Commodity Sale makes it convenient to both modify Commodity records and create Commodity Sold
            records when you make a sale of a commodity.</p>
        <section>
            <p>
                <label for="commodity">Type of Commodity Sold: </label>
                <input id="commodity" name="commodity" type="text" placeholder="BAT, BTC"
                       value="" required minlength="1" maxlength="15" size="15">
            </p>
            <p>
                <label for="amount">Amount of Commodity Sold <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts to be displayed should have 2 instead of 8 decimal places then ask Admin
                        to add your type of currency to the list of known fiat currencies.</span></span>: </label>
                <input id="amount" name="amount" type="text" value="" required minlength="1" maxlength="33" size="33"
                       placeholder=".0100600300440002">
            </p>
            <hr>
            <p>Time When Sale Happened</p>
            <?php require TIMEFORMFIELD; ?>
            <hr>
            <p>
                <label for="tax_year">Tax Year <span class="tooltip">ℹ️
                <span class="tooltiptext tooltip-top"><em>Tax Year</em> is usually the year you sold the
                    commodity.</span></span>: </label>
                <input id="tax_year" name="tax_year" type="text" value="<?= $g->saved_arr01['tax_year'] ?>"
                       required minlength="4" maxlength="6" size="6" placeholder="2018">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>