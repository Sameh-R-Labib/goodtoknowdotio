<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/InitializeABitcoinRecordProcessor/page" method="post">
        <h1>Create a ₿ 📽</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="address">₿ address: </label>
                <input id="address" name="address" type="text" value="" required minlength="8" maxlength="264"
                       size="60" spellcheck="false">
            </p>
            <p>
                <label for="initial_balance">Initial BTC Balance: </label>
                <input id="initial_balance" name="initial_balance" type="text" placeholder="0.01500002"
                       value="" required minlength="10" spellcheck="false" size="24" maxlength="24">
            </p>
            <p>
                <label for="current_balance">Current BTC Balance: </label>
                <input id="current_balance" name="current_balance" type="text" placeholder="0.01500002"
                       value="" required minlength="10" spellcheck="false" size="24" maxlength="24">
            </p>
            <p>
                <label for="currency">Currency (✅ emoji): </label>
                <input id="currency" name="currency" type="text" placeholder="💵" value="" required minlength="1"
                       maxlength="15" size="15">
            </p>
            <p>
                <label for="price_point">BTC Price at Time of Purchase <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts to be displayed should have 2 instead of  8 decimal places then ask the admin
                        to add your type of currency to the list of known fiat currencies.</span></span>: </label>
                <input id="price_point" name="price_point" type="text" placeholder="0.00" value="" minlength="1"
                       spellcheck="false" size="24" maxlength="24">
            </p>
            <hr>
            <p>Time at Purchase</p>
            <?php require TIMEFORMFIELD; ?>
            <hr>
            <p>
                <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
                <textarea id="comment" name="comment" rows="4" cols="77" wrap="soft" maxlength="800" spellcheck="false"
                          placeholder="This record is for BTC related to _ _ _ _ _."></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>