<?php include 'a_form_top.php'; ?>
<?php global $g; ?>
    <p class="tooltip">ℹ️
        <span class="tooltiptext tooltip-top">Records will be deleted automatically after the fourth year.</span>
    </p>
    <section>
        <p>
            <label for="label">️Label (✅ emoji): </label>
            <input id="label" name="label" type="text" value="<?= $g->saved_arr01['label'] ?>" required
                   minlength="3" maxlength="264" size="61" spellcheck="false"
                   placeholder="Monthly Linode hosting Fees for Web server of goodtoknow.io">
        </p>
        <p>
            <label for="year_paid">Year You Made the Expenditure: </label>
            <input id="year_paid" name="year_paid" type="text" value="<?= $g->saved_arr01['year_paid'] ?>" required
                   minlength="4" maxlength="6" size="6" placeholder="2018">
        </p>
        <p>
            <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
            <textarea id="comment" name="comment" rows="5" cols="77" wrap="soft" maxlength="1800"
                      placeholder="List the actual payments here."><?= $g->saved_arr01['comment'] ?></textarea>
        </p>
    </section>
<?php include 'a_form_bottom.php'; ?>