<?php include 'a_form_top.php'; ?>
<?php global $g; ?>
    <section>
        <p>
            <label for="label">Label: </label>
            <input id="label" name="label" type="text" value="<?= $g->saved_arr01['label'] ?>" required
                   minlength="3" maxlength="264" size="61" spellcheck="false"
                   placeholder="Customer six month contribution.">
        </p>
        <hr>
        <p>When</p>
        <?php require TIMEFORMFIELD; ?>
        <hr>
        <p>
            <label for="year_received">Year: </label>
            <input id="year_received" name="year_received" type="text"
                   value="<?= $g->saved_arr01['year_received'] ?>"
                   required minlength="4" maxlength="6" size="6" placeholder="2018">
        </p>
        <p>
            <label for="currency">Type <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">Do not change the currency type after you create this record unless you are sure the new
                        type uses same number of decimal places.</span></span>: </label>
            <input id="currency" name="currency" type="text"
                   value="<?= $g->saved_arr01['currency'] ?>" required minlength="1" maxlength="15" size="15"
                   placeholder="$ BTC BAT etc.">
        </p>
        <p>
            <label for="amount">Amount <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts to be displayed should have 2 instead of 8 decimal places then ask the admin
                        to add your type of currency to the list of known fiat currencies.</span></span>: </label>
            <input id="amount" name="amount" type="text" value="<?= $g->saved_arr01['amount'] ?>" required
                   minlength="1" maxlength="33" size="33" placeholder="500.29">
        </p>
        <p><span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">The two fields below have a different meaning depending on whether the income was in fiat
                    or in a commodity. If the income was fiat then</span></span>
            <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">enter a one (1) for <b>Price</b> and your fiat's symbol for <b>Fiat</b>.
            Otherwise, you can interpret the field labels literally and fill accordingly</span></span>
            <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">"Type of income" means type of currency or commodity you got paid in.</span></span>
        </p>
        <p>
            <label for="price">Price <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts for currency should have a different number of decimal places then ask the admin
                        to fix this.</span></span>: </label>
            <input id="price" name="price" type="text" placeholder="1.00" spellcheck="false"
                   value="<?= $g->saved_arr01['price'] ?>" size="33" minlength="1" maxlength="33">
        </p>
        <p>
            <label for="fiat">Priced In <span
                        class="tooltip">ℹ️<span
                            class="tooltiptext tooltip-top">Do not change the currency type after you create this record
                        unless you are sure the new type uses same number of decimal places.</span></span>: </label>
            <input id="fiat" name="fiat" type="text" placeholder="$, £, ¥, €"
                   value="<?= $g->saved_arr01['fiat'] ?>" required size="15" minlength="1" maxlength="15">
        </p>
        <p>
            <label for="comment">Comment: </label>
            <textarea id="comment" name="comment" rows="5" cols="71" wrap="soft" maxlength="1800"
                      placeholder="The frequency of this income is _ _ ."><?= $g->saved_arr01['comment'] ?></textarea>
        </p>
    </section>
<?php include 'a_form_bottom.php'; ?>