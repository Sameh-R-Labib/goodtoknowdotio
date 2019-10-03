<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/FineTuneACommoditySoldUpdate/page" method="post">
        <h1>Edit a Commodity Sold 📽</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">Warning: Records will be deleted automatically after the six year.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php require TIMEBOUGHTSOLDPREFILLED; ?>
            <p>
                <label for="price_bought">Price Bought: </label>
                <input id="price_bought" name="price_bought" type="text" required minlength="1" maxlength="24" size="24"
                       placeholder="150.24" value="<?= $object->price_bought ?>">
            </p>
            <p>
                <label for="price_sold">Price Sold: </label>
                <input id="price_sold" name="price_sold" type="text" required minlength="1" maxlength="24" size="24"
                       placeholder="150.24" value="<?= $object->price_sold ?>">
            </p>
            <p>
                <label for="currency_transacted">Currency Transacted (✅ emoji): </label>
                <input id="currency_transacted" name="currency_transacted" type="text" required minlength="1"
                       maxlength="15" size="15" placeholder="💵" value="<?= $object->currency_transacted ?>">
            </p>
            <p>
                <label for="commodity_amount">Commodity Amount: </label>
                <input id="commodity_amount" name="commodity_amount" type="text" required minlength="1" maxlength="24"
                       size="24" placeholder="150.24" value="<?= $object->commodity_amount ?>">
            </p>
            <p>
                <label for="commodity_type">Commodity Type (✅ emoji): </label>
                <input id="commodity_type" name="commodity_type" type="text" required minlength="1" maxlength="15"
                       size="15" placeholder="₿" value="<?= $object->commodity_type ?>">
            </p>
            <p>
                <label for="commodity_label">Commodity Label: </label>
                <input id="commodity_label" name="commodity_label" type="text" required minlength="8" maxlength="264"
                       size="60" spellcheck="false" value="<?= $object->commodity_label ?>">
            </p>
            <p>
                <label for="tax_year">Tax Year <span class="tooltip">ℹ️
                <span class="tooltiptext tooltip-top">Here the <em>tax year</em> is defined as the year you sold the commodity.</span>
            </span>: </label>
                <input id="tax_year" name="tax_year" type="text" required minlength="4" maxlength="6"
                       size="6" placeholder="2018" value="<?= $object->tax_year ?>">
            </p>
            <p>
                <label for="profit">Profit: </label>
                <input id="profit" name="profit" type="text" required minlength="1" maxlength="24" size="24"
                       placeholder="150.24" value="<?= $object->profit ?>">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>