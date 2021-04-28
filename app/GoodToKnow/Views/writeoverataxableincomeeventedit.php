<?php global $object; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/WriteOverATaxableIncomeEventUpdate/page" method="post">
        <h1>Edit a Taxable 💸 Event 📽</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">Label (✅ emoji): </label>
                <input id="label" name="label" type="text" value="<?= $object->label ?>" required minlength="3"
                       maxlength="264" size="61" spellcheck="false" placeholder="Customer six month contribution.">
            </p>
            <hr>
            <p>Time The Event Occured</p>
            <?php require TIMEFORMFIELDPREFILLED; ?>
            <hr>
            <p>
                <label for="year_received">Year for when event occured: </label>
                <input id="year_received" name="year_received" type="text" value="<?= $object->year_received ?>" required
                       minlength="4" maxlength="6" size="6" placeholder="2018">
            </p>
            <p>
                <label for="currency">Currency (✅ emoji): </label>
                <input id="currency" name="currency" type="text"
                       value="<?= $object->currency ?>" required minlength="1" maxlength="15" size="15" placeholder="💵">
            </p>
            <p>
                <label for="amount">Amount of currency received <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts to be displayed should have 2 instead of  8 decimal places then ask the admin
                        to add your type of currency to the list of known fiat currencies.</span></span>: </label>
                <input id="amount" name="amount" type="text"
                       value="<?= $object->amount ?>" required minlength="1" maxlength="24" size="24" placeholder="500.29">
            </p>
            <p>
                <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
                <textarea id="comment" name="comment" rows="4" cols="77" wrap="soft" maxlength="800"
                          placeholder="The frequency of this income is _ _ _ _."><?= $object->comment ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>