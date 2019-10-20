<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/AlterAPossibleTaxDeductionUpdate/page" method="post">
        <h1>Edit a 🤔 Tax ✍🏽🔽</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">Records will be deleted automatically after the fourth year.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">️Label (✅ emoji): </label>
                <input id="label" name="label" type="text" value="<?= $object->label ?>" required minlength="3"
                       maxlength="264" size="61" spellcheck="false"
                       placeholder="Monthly Linode hosting Fees for Web server of goodtoknow.io">
            </p>
            <p>
                <label for="year_paid">Year You Made the Expenditure: </label>
                <input id="year_paid" name="year_paid" type="text" value="<?= $object->year_paid ?>" required
                       minlength="4"
                       maxlength="6" size="6" placeholder="2018">
            </p>
            <p>
                <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
                <textarea id="comment" name="comment" rows="4" cols="87" wrap="soft" maxlength="800"
                          placeholder="List the actual payments here (Assuming there were multiple.)"><?= $object->comment ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>