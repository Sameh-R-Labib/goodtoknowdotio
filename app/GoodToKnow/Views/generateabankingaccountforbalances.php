<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/GenerateABankingAccountForBalancesProcessor/page" method="post">
    <h1>Create a 🏦ing 📒 for ⚖️s</h1>
    <h2>Initialize the record with its Banking Account for Balances acct_name</h2>
    <p>
        <small>✅ emoji.</small>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="acct_name">🏦 📒 for ⚖️s Name: </label>
            <input id="acct_name" name="acct_name" type="text" value="" required minlength="3" maxlength="30"
                   size="30" spellcheck="false" placeholder="Personal Credit Card">
        </p>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>