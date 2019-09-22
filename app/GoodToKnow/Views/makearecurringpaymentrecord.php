<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/MakeARecurringPaymentRecordProcessor/page" method="post">
        <h1>Create a 🌀 💳 📽</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">Label (✅ emoji): </label>
                <input id="label" name="label" type="text" value="" required minlength="4" maxlength="264"
                       size="60" spellcheck="false">
            </p>
            <p>
                <label for="currency">Currency (✅ emoji): </label>
                <input id="currency" name="currency" type="text" value="" required minlength="1" maxlength="15"
                       size="15">
            </p>
            <p>
                <label for="amount_paid">Amount of currency paid: </label>
                <input id="amount_paid" name="amount_paid" type="text" value="" required minlength="1" maxlength="16"
                       size="16">
            </p>
            <p>
                <label for="time">Unix time at last payment: </label>
                <input id="time" name="time" type="text" value="" minlength="10" maxlength="22" size="22"
                       placeholder="1560190617">
            </p>
            <p>
                <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
                <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800"
                          placeholder="The frequency of this payment is _ _ _ _."></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>