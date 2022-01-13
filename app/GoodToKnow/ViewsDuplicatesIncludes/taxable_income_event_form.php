<?php include 'a_form_top.php'; ?>
<?php global $g; ?>
    <section>
        <p>
            <label for="label">Label (✅ emoji): </label>
            <input id="label" name="label" type="text" value="<?= $g->saved_arr01['label'] ?>" required
                   minlength="3" maxlength="264" size="61" spellcheck="false"
                   placeholder="Customer six month contribution.">
        </p>
        <hr>
        <p>Time The Event Occured</p>
        <?php require TIMEFORMFIELD; ?>
        <hr>
        <p>
            <label for="year_received">Year for when event occured: </label>
            <input id="year_received" name="year_received" type="text"
                   value="<?= $g->saved_arr01['year_received'] ?>"
                   required minlength="4" maxlength="6" size="6" placeholder="2018">
        </p>
        <p>
            <label for="currency">Currency (✅ emoji) <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">Do not change the currency type after you create this record unless you are sure the new
                        type uses same number of decimal places.</span></span>: </label>
            <input id="currency" name="currency" type="text"
                   value="<?= $g->saved_arr01['currency'] ?>" required minlength="1" maxlength="15" size="15"
                   placeholder="💵">
        </p>
        <p>
            <label for="amount">Amount of currency received <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts to be displayed should have 2 instead of  8 decimal places then ask the admin
                        to add your type of currency to the list of known fiat currencies.</span></span>: </label>
            <input id="amount" name="amount" type="text" value="<?= $g->saved_arr01['amount'] ?>" required
                   minlength="1" maxlength="33" size="33" placeholder="500.29">
        </p>
        <p>
            <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
            <textarea id="comment" name="comment" rows="5" cols="77" wrap="soft" maxlength="800"
                      placeholder="The frequency of this income is _ _ ."><?= $g->saved_arr01['comment'] ?></textarea>
        </p>
    </section>
<?php include 'a_form_bottom.php'; ?>