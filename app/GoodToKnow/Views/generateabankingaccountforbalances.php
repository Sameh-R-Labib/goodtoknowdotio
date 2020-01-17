<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/GenerateABankingAccountForBalancesProcessor/page" method="post">
        <h1>Create a 🏦ing 📒 for ⚖️s</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="acct_name">Bank Account Name (✅ emoji): </label>
                <input id="acct_name" name="acct_name" type="text" value="" required minlength="3" maxlength="30"
                       size="34" spellcheck="false" placeholder="Personal Credit Card">
            </p>
            <hr>
            <p>Time at Beginning</p>
            <?php require TIMEFORMFIELD; ?>
            <hr>
            <p>
                <label for="start_balance">Balance at Beginning <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts are being displayed having 8 instead of 2 decimal places then let the admin
                        know to add your type of currency to the list of known fiat currencies.</span></span>: </label>
                <input id="start_balance" name="start_balance" type="text" value="" required minlength="1"
                       maxlength="24" size="24" placeholder="-85.14">
            </p>
            <p>
                <label for="currency">Currency (✅ emoji): </label>
                <input id="currency" name="currency" type="text" value="" required minlength="1" maxlength="15"
                       size="15" placeholder="💵">
            </p>
            <p>
                <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
                <textarea id="comment" name="comment" rows="4" cols="99" wrap="soft" maxlength="800" spellcheck="false"
                          placeholder="This banking account is my _ _ _ _ bank's _ _ _ _ account."></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>