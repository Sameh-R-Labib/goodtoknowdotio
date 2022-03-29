<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/add_income_commodity_form_processor/page" method="post">
        <h1>Add Records For Taxable Remuneration and Commodity</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">Label: </label>
                <input id="label" name="label" type="text" value="<?= $g->saved_arr01['label'] ?>" required
                       minlength="3" maxlength="264" size="61" spellcheck="false"
                       placeholder="Customer six month contribution.">
            </p>
            <hr>
            <p>Time When Remuneration Was Received</p>
            <?php require TIMEFORMFIELD; ?>
            <hr>
            <p>
                <label for="year">Year for When Event Occured: </label>
                <input id="year" name="year" type="text"
                       value="<?= $g->saved_arr01['year'] ?>"
                       required minlength="4" maxlength="6" size="6" placeholder="2018">
            </p>
            <p>
                <label for="commodity">Commodity Type of Remuneration <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">Do not change the commodity type after you create this record unless you are sure the new
                        type uses same number of decimal places.</span></span>: </label>
                <input id="commodity" name="commodity" type="text" placeholder="BAT, BTC"
                       value="<?= $g->saved_arr01['commodity'] ?>" required minlength="1" maxlength="15" size="15">
            </p>
            <p>
                <label for="amount">Amount of Remuneration <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts to be displayed should have 2 instead of 8 decimal places then ask the admin
                        to add your type of currency to the list of known fiat currencies.</span></span>: </label>
                <input id="amount" name="amount" type="text" value="<?= $g->saved_arr01['amount'] ?>" required
                       minlength="1" maxlength="33" size="33" placeholder=".0100600300440002">
            </p>
            <p>
                <label for="currency">Currency Used to Price the Commodity <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">Do not change the currency type after you create this record unless you are sure the new
                        type uses same number of decimal places.</span></span>: </label>
                <input id="currency" name="currency" type="text" placeholder="$, £, ¥, €"
                       value="<?= $g->saved_arr01['currency'] ?>" required size="15" minlength="1" maxlength="15">
            </p>
            <p>
                <label for="price">Commodity's Price at Time of Remuneration <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts for currency should have a different number of decimal places then ask the admin
                        to fix this.</span></span>: </label>
                <input id="price" name="price" type="text" placeholder="0.00" spellcheck="false"
                       value="<?= $g->saved_arr01['price'] ?>" size="33" minlength="1" maxlength="33">
            </p>
            <p>
                <label for="comment">Comment: </label>
                <textarea id="comment" name="comment" rows="5" cols="67" wrap="soft" maxlength="1800"
                          placeholder="The frequency of this income is _ _ ."><?= $g->saved_arr01['comment'] ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>