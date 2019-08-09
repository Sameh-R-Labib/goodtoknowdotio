<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/AlterAPossibleTaxDeductionUpdate/page" method="post">
    <h2><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $object->label; ?></h2>
    <p>
        <small>✅ emoji for the label and comment.</small>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="label">🏦ing 🔃 for ⚖️ Label: </label>
            <input id="label" name="label" type="text" value="<?= $object->label ?>" required minlength="3"
                   maxlength="264" size="61" spellcheck="false"
                   placeholder="Monthly Linode hosting Fees for Web server of goodtoknow.io">
        </p>
        <p>
            <label for="year_paid">Year You Made The Expenditure: </label>
            <input id="year_paid" name="year_paid" type="text" value="<?= $object->year_paid ?>" required minlength="4"
                   maxlength="6" size="6" placeholder="2018">
        </p>
        <p>
            <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
            <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800"
                      placeholder="List the actual payments here (Assuming there were multiple.)"><?= $object->comment ?></textarea>
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>