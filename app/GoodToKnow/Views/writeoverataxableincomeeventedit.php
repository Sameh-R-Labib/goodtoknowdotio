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
        <p>
            <label for="time">Unix time for when event occured: </label>
            <input id="time" name="time" type="text" value="<?= $object->time ?>" required minlength="10" maxlength="22"
                   size="22" placeholder="1560190617">
        </p>
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
            <label for="amount">Amount of currency received: </label>
            <input id="amount" name="amount" type="text"
                   value="<?= $object->amount ?>" required minlength="1" maxlength="16" size="16" placeholder="500.29">
        </p>
        <p>
            <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
            <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800"
                      placeholder="The frequency of this income is _ _ _ _."><?= $object->comment ?></textarea>
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>