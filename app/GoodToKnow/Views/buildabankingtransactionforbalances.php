<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/BuildABankingTransactionForBalancesProcessor/page" method="post">
        <h1>Create Transaction</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">A negative (-) amount shall signify money spent.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">Label (✅ emoji): </label>
                <input id="label" name="label" type="text" value="" required minlength="3" maxlength="264"
                       size="61" spellcheck="false" placeholder="Monthly Car Payment">
            </p>
            <hr>
            <p>Time</p>
            <?php require TIMEFORMFIELD; ?>
            <hr>
            <p>
                <label for="amount">Amount <span class="tooltip">ℹ️<span class="tooltiptext
                tooltip-top">If the amounts to be displayed should have 2 instead of  8 decimal places then ask the admin
                        to add your type of currency to the list of known fiat currencies.</span></span>: </label>
                <input id="amount" name="amount" type="text" value="" required minlength="1" maxlength="24" size="24"
                       placeholder="-105.39">
            </p>
        </section>
        <section>
            <?= $g->account_type ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>