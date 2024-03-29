<?php include 'a_form_top.php'; ?>
<?php global $g; ?>
    <section>
        <p>
            <label for="label">Label: </label>
            <input id="label" name="label" type="text" required minlength="3" maxlength="264"
                   size="60" spellcheck="false" placeholder="Cell Phone Each Month"
                   value="<?= $g->saved_arr01['label'] ?>"
        </p>
        <p>
            <label for="currency">Currency <span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top">Do not change the currency type after you create this record unless you are sure the new
                        type uses same number of decimal places.</span></span>: </label>
            <input id="currency" name="currency" type="text" required minlength="1" maxlength="15"
                   size="15" placeholder="$, £, ¥, €" value="<?= $g->saved_arr01['currency'] ?>">
        </p>
        <p>
            <label for="amount_paid">Amount paid <span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top">Contact Admin if you are not seeing the correct number of decimal places.</span></span>:
            </label>
            <input id="amount_paid" name="amount_paid" type="text" required minlength="1" maxlength="33"
                   size="33" placeholder="108.49" value="<?= $g->saved_arr01['amount_paid'] ?>">
        </p>
        <hr>
        <p>Time at Last Payment</p>
        <?php require TIMEFORMFIELD; ?>
        <hr>
        <p>
            <label for="comment">Comment:<br></label>
            <textarea id="comment" name="comment" rows="5" cols="67" wrap="soft" maxlength="1800"
                      placeholder="Notes to self."><?= $g->saved_arr01['comment'] ?></textarea>
        </p>
    </section>
<?php include 'a_form_bottom.php'; ?>