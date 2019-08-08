<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/MakeARecurringPaymentRecordProcessor/page" method="post">
    <h1>Create a 🌀 💳 📽</h1>
    <h2>Initialize the record with its recurring_payment label</h2>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="label">🌀 💳 📽's label (✅ emoji): </label>
            <input id="label" name="label" type="text" value="" required minlength="4" maxlength="264"
                   size="67" spellcheck="false">
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