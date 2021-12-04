<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/FatherACommoditySoldProcessor/page" method="post">
        <h1>Create a Commodity Sold Record</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">Warning: Commodity Sold older than six years get purged.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php require TIMEBOUGHTSOLD; ?>
            <p>
                <label for="price_bought">Price Bought: </label>
                <input id="price_bought" name="price_bought" type="text" value="<?= $g->saved_arr01['price_bought'] ?>"
                       required minlength="1" maxlength="24" size="24" placeholder="150.24">
            </p>
            <p>
                <label for="price_sold">Price Sold <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts should have 2 decimal places ask admin
                        to add your currency to list of fiat.</span></span>: </label>
                <input id="price_sold" name="price_sold" type="text" value="<?= $g->saved_arr01['price_sold'] ?>"
                       required minlength="1" maxlength="24" size="24" placeholder="150.24">
            </p>
            <p>
                <label for="currency_transacted">Currency Transacted (✅ emoji): </label>
                <input id="currency_transacted" name="currency_transacted" type="text"
                       value="<?= $g->saved_arr01['currency_transacted'] ?>" required minlength="1"
                       maxlength="15" size="15" placeholder="💵">
            </p>
            <p>
                <label for="commodity_amount">Commodity Amount <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts should have 2 decimal places ask admin
                        to add your currency to the list of fiat.</span></span>: </label>
                <input id="commodity_amount" name="commodity_amount" type="text"
                       value="<?= $g->saved_arr01['commodity_amount'] ?>" required minlength="1" maxlength="24"
                       size="24" placeholder="150.24">
            </p>
            <p>
                <label for="commodity_type">Commodity Type (✅ emoji): </label>
                <input id="commodity_type" name="commodity_type" type="text"
                       value="<?= $g->saved_arr01['commodity_type'] ?>" required minlength="1" maxlength="15"
                       size="15" placeholder="₿">
            </p>
            <p>
                <label for="commodity_label">Commodity Label: </label>
                <input id="commodity_label" name="commodity_label" type="text"
                       value="<?= $g->saved_arr01['commodity_label'] ?>" required minlength="8" maxlength="264"
                       size="54" spellcheck="false">
            </p>
            <p>
                <label for="tax_year">Tax Year <span class="tooltip">ℹ️
                <span class="tooltiptext tooltip-top">Here the <em>tax year</em> is defined as the year you sold the
                    commodity.</span></span>: </label>
                <input id="tax_year" name="tax_year" type="text" value="<?= $g->saved_arr01['tax_year'] ?>"
                       required minlength="4" maxlength="6" size="6" placeholder="2018">
            </p>
            <p>
                <label for="profit">Profit: </label>
                <input id="profit" name="profit" type="text" value="<?= $g->saved_arr01['profit'] ?>"
                       required minlength="1" maxlength="24" size="24" placeholder="150.24">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>