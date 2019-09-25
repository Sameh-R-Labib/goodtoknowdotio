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
                <input id="price_point" name="price_point" type="text" placeholder="0.00" value="" minlength="2"
                       spellcheck="false" size="13" maxlength="13">
            </p>
            <p>
                <label for="date">Date (mm/dd/yyyy): </label>
                <input id="date" name="date" type="text" required minlength="10" maxlength="14" size="14"
                       spellcheck="false" placeholder="06/21/2009">
            </p>
            <p>
                <label for="hour">Hour (range 0-23): </label>
                <input id="hour" name="hour" type="text" required minlength="1" maxlength="2" size="2"
                       spellcheck="false" placeholder="14">
            </p>
            <p>
                <label for="minute">Minute (range 0-59): </label>
                <input id="minute" name="minute" type="text" required minlength="1" maxlength="2" size="2"
                       spellcheck="false" placeholder="27">
            </p>
            <p>
                <label for="second">Second (range 0-59): </label>
                <input id="second" name="second" type="text" required minlength="1" maxlength="2" size="2"
                       spellcheck="false" placeholder="52">
            </p>
            <p>
                <label for="timezone">PHP Time Zone (<span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php">www.php.net/manual/en/timezones.php</a></span></span>️):
                </label>
                <input id="timezone" name="timezone" type="text" placeholder="America/New_York" value="" required
                       minlength="2" maxlength="60" size="18">
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