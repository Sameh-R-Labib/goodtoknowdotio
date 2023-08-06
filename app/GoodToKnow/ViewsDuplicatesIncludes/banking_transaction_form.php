<?php include 'a_form_top.php'; ?>
<?php global $g; ?>
    <p class="tooltip">ⅈ
        <span class="tooltiptext tooltip-top">A negative (-) amount shall signify money spent.</span>
    </p>
    <section>
        <p>
            <label for="label">Label: </label>
            <input id="label" name="label" type="text" value="<?= $g->saved_arr01['label'] ?>" required
                   minlength="3" maxlength="264" size="61" spellcheck="false"
                   placeholder="Internet Service Fee">
        </p>
        <hr>
        <p>Time</p>
        <?php require TIMEFORMFIELD; ?>
        <hr>
        <p>
            <label for="amount">Amount <span class="tooltip">ⅈ<span class="tooltiptext
                tooltip-top">Contact Admin if you are not seeing the correct number of decimal places.</span></span>:
            </label>
            <input id="amount" name="amount" type="text" value="<?= $g->saved_arr01['amount'] ?>" required
                   minlength="1" maxlength="33" size="33" placeholder="-105.39">
        </p>
    </section>
    <section>
        <?= $g->account_type ?>
    </section>
<?php include 'a_form_bottom.php'; ?>