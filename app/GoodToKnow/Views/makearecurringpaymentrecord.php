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
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>