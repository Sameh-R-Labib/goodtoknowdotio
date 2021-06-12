<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/PopulateABankingAccountForBalancesSubmit/page" method="post">
        <h1>Edit a 🏦ing 📒 for ⚖️s</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="acct_name">Bank Account Name (✅ emoji): </label>
                <input id="acct_name" name="acct_name" type="text"
                       value="<?= $g->object->acct_name ?>" required minlength="3" maxlength="30" size="34"
                       spellcheck="false" placeholder="Personal Credit Card">
            </p>
            <hr>
            <p>Time at Beginning</p>
            <?php require TIMEFORMFIELDPREFILLED; ?>
            <hr>
            <p>
                <label for="start_balance">Balance at Beginning <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts to be displayed should have 2 instead of  8 decimal places then ask the admin
                        to add your type of currency to the list of known fiat currencies.</span></span>: </label>
                <input id="start_balance" name="start_balance" type="text"
                       value="<?= $g->object->start_balance ?>" required minlength="1" maxlength="24" size="24">
            </p>
            <p>
                <label for="currency">Currency (✅ emoji): </label>
                <input id="currency" name="currency" type="text"
                       value="<?= $g->object->currency ?>" required minlength="1" maxlength="15" size="15">
            </p>
            <p>
                <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
                <textarea id="comment" name="comment" rows="5" cols="77" wrap="soft" maxlength="800" spellcheck="false"
                          placeholder="This banking account is my _ _ _ _ bank's _ _ _ _ account."><?= $g->object->comment ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>