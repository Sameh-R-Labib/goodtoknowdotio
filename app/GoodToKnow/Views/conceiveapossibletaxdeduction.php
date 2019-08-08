<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/ConceiveAPossibleTaxDeductionProcessor/page" method="post">
    <h1>Create a 🤔 Tax ✍🏽🔽</h1>
    <h2>Initialize the possible_tax_deduction record</h2>
    <p>* Records will be deleted automatically after the fourth year. *</p>
    <p>
        <small>✅ emoji for the label.</small>
    </p>
    <p>
        <small>year_paid is the year in which you spent the money.</small>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="label">🤔 Tax ✍🏽🔽 Label: </label>
            <input id="label" name="label" type="text" value="" required minlength="3" maxlength="264"
                   size="61" spellcheck="false"
                   placeholder="Monthly Linode hosting Fees for Web server of goodtoknow.io">
        </p>
        <p>
            <label for="year_paid">Year You Made the Expenditure: </label>
            <input id="year_paid" name="year_paid" type="text" value="" required minlength="4" maxlength="6"
                   size="6" placeholder="2018">
        </p>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>