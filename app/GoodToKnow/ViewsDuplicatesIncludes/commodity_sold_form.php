<?php include 'a_form_top.php'; ?>
<?php global $g; ?>
    <p><span class="tooltip">ℹ️ <span class="tooltiptext tooltip-top">Warning: Records will be deleted automatically
                after the sixth year back.</span></span>
        <span class="tooltip">ℹ️
        <span class="tooltiptext tooltip-top">C = Commodity. CS = Commodity Sold. A <b>commodity sold record</b> represents
            a portion of a <b>commodity record</b> which was sold.</span></span>
        <span class="tooltip">ℹ️ <span class="tooltiptext tooltip-top">In other words you may have sold 30 BTC at one
                point in time but this commodity sold record which you are creating or editing only represents the</span></span>
        <span class="tooltip">ℹ️ <span class="tooltiptext tooltip-top">portion of those 30 BTC which came from one
        particular commodity (purchase) record.</span></span>
    </p>
    <section>
        <?php require TIMEBOUGHTSOLD; ?>
        <p>
            <label for="price_bought">Price Per Unit — Bought: </label>
            <input id="price_bought" name="price_bought" type="text" value="<?= $g->saved_arr01['price_bought'] ?>"
                   required minlength="1" maxlength="33" size="33" placeholder="150.33">
        </p>
        <p>
            <label for="price_sold">Price Per Unit — Sold <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts should have 2 decimal places ask Admin to add your currency to list of
                            fiat.</span></span>: </label>
            <input id="price_sold" name="price_sold" type="text" value="<?= $g->saved_arr01['price_sold'] ?>"
                   required minlength="1" maxlength="33" size="33" placeholder="150.33">
        </p>
        <p>
            <label for="currency_transacted">Priced In — Fiat <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">Do not change the currency type after you create this record unless you are sure the new
                        type uses same number of decimal places.</span></span>: </label>
            <input id="currency_transacted" name="currency_transacted" type="text"
                   value="<?= $g->saved_arr01['currency_transacted'] ?>" required
                   minlength="1" maxlength="15" size="15" placeholder="$, £, ¥, €">
        </p>
        <p>
            <label for="commodity_amount">Amount Sold <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts should have 2 decimal places ask Admin to add your currency to the list of
                            fiat.</span></span>: </label>
            <input id="commodity_amount" name="commodity_amount" type="text"
                   value="<?= $g->saved_arr01['commodity_amount'] ?>"
                   required minlength="1" maxlength="33" size="33" placeholder="150.33">
        </p>
        <p>
            <label for="commodity_type">Type <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">Do not change the commodity type after you create this record unless you are sure the new
                        type uses same number of decimal places.</span></span>: </label>
            <input id="commodity_type" name="commodity_type" type="text"
                   value="<?= $g->saved_arr01['commodity_type'] ?>"
                   required minlength="1" maxlength="15" size="15" placeholder="BTC, BAT, OXT">
        </p>
        <p>
            <label for="commodity_label">Label Of C From Which This CS C Was Sold: </label>
            <input id="commodity_label" name="commodity_label" type="text"
                   value="<?= $g->saved_arr01['commodity_label'] ?>" required minlength="8" maxlength="264"
                   size="54" spellcheck="false" placeholder="bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq">
        </p>
        <p>
            <label for="tax_year">Year <span class="tooltip">ℹ️
                <span class="tooltiptext tooltip-top"><em>Tax Year</em> is usually the year you sold the
                    commodity.</span></span>: </label>
            <input id="tax_year" name="tax_year" type="text" value="<?= $g->saved_arr01['tax_year'] ?>"
                   required minlength="4" maxlength="6" size="6" placeholder="2018">
        </p>
        <p>
            <label for="profit">Profit — Fiat: </label>
            <input id="profit" name="profit" type="text" value="<?= $g->saved_arr01['profit'] ?>"
                   required minlength="1" maxlength="33" size="33" placeholder="150.33">
        </p>
    </section>
<?php include 'a_form_bottom.php'; ?>