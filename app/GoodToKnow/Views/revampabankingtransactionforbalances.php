<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/RevampABankingTransactionForBalancesTimeRange/page" method="post">
    <h1>Edit a 🏦ing 🔃 for ⚖️s</h1>
    <h2>Narrow down the selection for choosing 🔃</h2>
    <p>Which time range does the transaction fall under?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <label for="A" class="radio">
            <input type="radio" id="A" name="choice" value="A">
            Last 30 days
        </label>
        <label for="B" class="radio">
            <input type="radio" id="B" name="choice" value="B">
            30 - 60 day range
        </label>
        <label for="C" class="radio">
            <input type="radio" id="C" name="choice" value="C">
            60 - 90 day range
        </label>
        <label for="D" class="radio">
            <input type="radio" id="D" name="choice" value="D">
            Beyond 90 days
        </label>
        <label for="E" class="radio">
            <input type="radio" id="E" name="choice" value="E">
            All<br>
        </label>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>