<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/InitializeABitcoinRecordProcessor/page" method="post">
        <h1>Create a ₿ 📽</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="address">₿ address: </label>
                <input id="address" name="address" type="text" value="" required minlength="8" maxlength="264"
                       size="67" spellcheck="false">
            </p>
            <p>
                <label for="initial_balance">Initial BTC Balance: </label>
                <input id="initial_balance" name="initial_balance" type="text" placeholder="0.00000000"
                       value="" minlength="10" spellcheck="false" size="17" maxlength="17">
            </p>
            <p>
                <label for="current_balance">Current BTC Balance: </label>
                <input id="current_balance" name="current_balance" type="text" placeholder="0.00000000"
                       value="" required minlength="10" spellcheck="false" size="17" maxlength="17">
            </p>
            <p>
                <label for="currency">Currency (✅ emoji): </label>
                <input id="currency" name="currency" type="text" placeholder="💵" value="" required minlength="1"
                       maxlength="15" size="15">
            </p>
            <p>
                <label for="price_point">BTC Price at Time of Purchase: </label>
                <input id="price_point" name="price_point" type="text" placeholder="0.00"
                       value="" minlength="2" spellcheck="false" size="13" maxlength="13">
            </p>
            <p>
                <label for="time">Unix Time at Purchase: </label>
                <input id="time" name="time" type="text" placeholder="1560190617" value="" minlength="10" size="22"
                       maxlength="22">
            </p>
            <p>
                <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
                <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800" spellcheck="false"
                          placeholder="This record is for BTC related to _ _ _ _ _."></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>