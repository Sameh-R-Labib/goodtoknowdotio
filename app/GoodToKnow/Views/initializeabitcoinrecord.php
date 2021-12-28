<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/InitializeABitcoinRecordProcessor/page" method="post">
        <h1>Create a Commodity Record</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="address">Commodity (aka. C.) Address or Label: </label>
                <input id="address" name="address" type="text" value="<?= $g->saved_arr01['address'] ?>" required
                       minlength="8" maxlength="264" size="60" spellcheck="false"
                       placeholder="bc1qar0srrr7xfkvy5l643lydnw9re59gtzzwf5mdq">
            </p>
            <p>
                <label for="initial_balance">Initial C. Amount: </label>
                <input id="initial_balance" name="initial_balance" type="text" placeholder="0.01500002"
                       value="<?= $g->saved_arr01['initial_balance'] ?>" required minlength="1" spellcheck="false"
                       size="33" maxlength="33">
            </p>
            <p>
                <label for="current_balance">Current C. Amount: </label>
                <input id="current_balance" name="current_balance" type="text" placeholder="0.01500002"
                       value="<?= $g->saved_arr01['current_balance'] ?>" required minlength="1" spellcheck="false"
                       size="33" maxlength="33">
            </p>
            <p>
                <label for="currency">Currency Used For Purchase of C. (✅ emoji): </label>
                <input id="currency" name="currency" type="text" placeholder="💵"
                       value="<?= $g->saved_arr01['currency'] ?>" required minlength="1" maxlength="15" size="15">
            </p>
            <p>
                <label for="price_point">Commodity's Price at Time of Purchase <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts for currency should have a different number of decimal places then ask the admin
                        to fix this.</span></span>: </label>
                <input id="price_point" name="price_point" type="text" placeholder="0.00"
                       value="<?= $g->saved_arr01['price_point'] ?>" minlength="1" spellcheck="false" size="33"
                       maxlength="33">
            </p>
            <hr>
            <p>Time at Purchase</p>
            <?php require TIMEFORMFIELD; ?>
            <hr>
            <p>
                <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
                <textarea id="comment" name="comment" rows="5" cols="77" wrap="soft" maxlength="800" spellcheck="false"
                          placeholder="This record is for BTC related to _ _."><?= $g->saved_arr01['comment'] ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>