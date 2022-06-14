<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/produce_a_bank_acct_observer_processor/page" method="post">
        <h2>Who will be an observer?</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">A bank_account_observer specifies who
         can observe your bank account and its transactions.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="observer_username">U/N of Observer: </label>
                <input id="observer_username" name="observer_username" type="text" required minlength="7" maxlength="12"
                       size="12" spellcheck="false">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>