<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/OmitABankingTransactionForBalancesTimeRange/page" method="post">
        <h1>Delete a Bank Transaction for Ledger</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which time range does the transaction fall under?</p>
        <section>
            <label for="A" class="radio">
                <input type="radio" id="A" name="choice" value="A">
                Around now<br>
            </label>
            <label for="B" class="radio">
                <input type="radio" id="B" name="choice" value="B">
                30 - 60 day range<br>
            </label>
            <label for="C" class="radio">
                <input type="radio" id="C" name="choice" value="C">
                60 - 90 day range<br>
            </label>
            <label for="D" class="radio">
            <input type="radio" id="D" name="choice" value="D">
            Beyond 90 days<br>
        </label>
        <label for="E" class="radio">
            <input type="radio" id="E" name="choice" value="E">
            All<br>
        </label>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>