<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Delete a Bank Transaction for Ledger</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which time range does the transaction fall under?</p>
        <section>
            <a href="/ax1/omit_a_banking_transaction_for_balances_time_range/page/A" class="choose">Around now</a>
            <a href="/ax1/omit_a_banking_transaction_for_balances_time_range/page/B" class="choose">30 - 60 day
                range</a>
            <a href="/ax1/omit_a_banking_transaction_for_balances_time_range/page/C" class="choose">60 - 90 day
                range</a>
            <a href="/ax1/omit_a_banking_transaction_for_balances_time_range/page/D" class="choose">Beyond 90 days</a>
            <a href="/ax1/omit_a_banking_transaction_for_balances_time_range/page/E" class="choose">All</a>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>