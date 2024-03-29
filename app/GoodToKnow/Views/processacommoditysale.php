<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/process_a_commodity_sale_form_processor/page" method="post">
        <h1>Process A Commodity Sale</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>This feature makes it convenient to modify Commodity records and create their associated Capital Gain
            records when you sell a commodity at a particular point in time.</p>
        <section>
            <p>
                <label for="commodity">Type of Commodity Sold: </label>
                <input id="commodity" name="commodity" type="text" placeholder="BAT, BTC"
                       value="" required minlength="1" maxlength="15" size="15">
            </p>
            <p>
                <label for="amount">Amount of Commodity Sold <span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top">Contact Admin if you are not seeing the correct number of decimal places.</span></span>:
                </label>
                <input id="amount" name="amount" type="text" value="" required minlength="1" maxlength="33" size="33"
                       placeholder=".0100600300440002">
            </p>
            <hr>
            <p>Time When Sale Happened</p>
            <?php require TIMEFORMFIELD; ?>
            <hr>
            <p>
                <label for="tax_year">Tax Year <span class="tooltip">ⅈ
                <span class="tooltiptext tooltip-top"><em>Tax Year</em> is usually the year you sold the
                    commodity.</span></span>: </label>
                <input id="tax_year" name="tax_year" type="text" value=""
                       required minlength="4" maxlength="6" size="6" placeholder="2018">
            </p>
            <p>
                <label for="currency">Currency Used to Price the Commodity <span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top">Do not change the currency type after you create this record unless you are sure the new
                        type uses same number of decimal places.</span></span>: </label>
                <input id="currency" name="currency" type="text" placeholder="$, £, ¥, €"
                       value="" required size="15" minlength="1" maxlength="15">
            </p>
            <p>
                <label for="price_sold">Price Per Unit — Sold <span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top">If the amounts should have 2 decimal places ask Admin to add your currency to list of
                            fiat.</span></span>: </label>
                <input id="price_sold" name="price_sold" type="text" value="" required minlength="1" maxlength="33"
                       size="33" placeholder="35000.00">
            </p>
            <p>
                <label for="reason">Reason For Selling: </label>
                <input id="reason" name="reason" type="text" value="" required minlength="3" maxlength="54"
                       size="54" spellcheck="false" placeholder="blockchain fee (no period at end)">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>