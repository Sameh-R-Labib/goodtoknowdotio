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
            <label for="currency">Type of Units I Was Paid In <span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top">Do not change the currency type after you create this record unless you are sure the new
                        type uses same number of decimal places.</span></span>: </label>
            <input id="currency" name="currency" type="text"
                   value="<?= $g->saved_arr01['currency'] ?>" required minlength="1" maxlength="15" size="15"
                   placeholder="$, BTC or BAT etc.">
        </p>
        <p>
            <label for="amount">Amount of Those Units <span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top">Contact Admin if you are not seeing the correct number of decimal places.</span></span>:
            </label>
            <input id="amount" name="amount" type="text" value="<?= $g->saved_arr01['amount'] ?>" required
                   minlength="1" maxlength="33" size="33" placeholder="500.29">
        </p>
        <p><span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top">If the type of unit you were paid in is your local currency then</span></span>
            <span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top"> then put its symbol in the 2nd field below and put a 1 in the other field.</span></span>
        </p>
        <p>
            <label for="price">Price of The Unit I Was Paid In<span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top">If the currency should be using a different number of decimal places then ask the admin
                        to fix this.</span></span>: </label>
            <input id="price" name="price" type="text" placeholder="1.00" spellcheck="false"
                   value="<?= $g->saved_arr01['price'] ?>" size="33" minlength="1" maxlength="33">
        </p>
        <p>
            <label for="fiat">Currency Used For Price of Unit I Was Paid In<span
                        class="tooltip">ⅈ<span
                            class="tooltiptext tooltip-top">Do not change the currency type after you create this record
                        unless you are sure the new type uses same number of decimal places.</span></span>: </label>
            <input id="fiat" name="fiat" type="text" placeholder="$, £, ¥ or € etc."
                   value="<?= $g->saved_arr01['fiat'] ?>" required size="15" minlength="1" maxlength="15">
        </p>
        <p>
            <label for="comment">Comment:<br></label>
            <textarea id="comment" name="comment" rows="5" cols="67" wrap="soft" maxlength="1800"
                      placeholder="The frequency of this income is _ _ ."><?= $g->saved_arr01['comment'] ?></textarea>
        </p>
    </section>
<?php include 'a_form_bottom.php'; ?>