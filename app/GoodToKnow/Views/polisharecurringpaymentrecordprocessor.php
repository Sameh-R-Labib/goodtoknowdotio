<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/PolishARecurringPaymentRecordSubmit/page" method="post">
        <h2><?php /** @noinspection PhpUndefinedVariableInspection */
            echo $recurring_payment_object->label; ?></h2>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">Label (✅ emoji): </label>
                <input id="label" name="label" type="text"
                       value="<?php /** @noinspection PhpUndefinedVariableInspection */
                       echo $recurring_payment_object->label; ?>" required minlength="4" maxlength="264" size="60"
                       spellcheck="false" placeholder="Cell Phone Each Month">
            </p>
            <p>
                <label for="currency">Currency (✅ emoji): </label>
                <input id="currency" name="currency" type="text"
                       value="<?= $recurring_payment_object->currency ?>" required minlength="1" maxlength="15"
                       size="15" placeholder="💵">
            </p>
            <p>
                <label for="amount_paid">Amount of currency paid: </label>
                <input id="amount_paid" name="amount_paid" type="text"
                       value="<?= $recurring_payment_object->amount_paid ?>" required minlength="1" maxlength="16"
                       size="16" placeholder="108.49">
            </p>
            <hr>
            <p>Time at Last Payment</p>
            <?php require TIMEFORMFIELDPREFILLED; ?>
            <hr>
            <p>
                <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
                <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800"
                          placeholder="Notes to self."><?= $recurring_payment_object->comment ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>