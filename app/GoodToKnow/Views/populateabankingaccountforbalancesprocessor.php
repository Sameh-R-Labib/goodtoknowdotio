<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/PopulateABankingAccountForBalancesSubmit/page" method="post">
    <h2><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $object->acct_name; ?></h2>
    <?php require SESSIONMESSAGE; ?>
    <p>
        <label for="acct_name">Account Name (✅ emoji): </label>
        <input id="acct_name" name="acct_name" type="text"
               value="<?= $object->acct_name ?>" required minlength="3" maxlength="30" size="30"
               spellcheck="false" placeholder="Personal Credit Card">
    </p>
    <p>
        <label for="start_time">Unix time at Beginning: </label>
        <input id="start_time" name="start_time" type="text"
               value="<?= $object->start_time ?>" minlength="10" maxlength="22" size="22"
               placeholder="1560190617">
    </p>
    <p>
        <label for="start_balance">Balance at Beginning: </label>
        <input id="start_balance" name="start_balance" type="text"
               value="<?= $object->start_balance ?>" required minlength="1" maxlength="16" size="16">
    </p>
    <p>
        <label for="comment">Comment (🚫 html 🚫 markdown ✅ emoji ✅ line-break): </label>
        <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800" spellcheck="false"
                  placeholder="This banking account is my _ _ _ _ bank's _ _ _ _ account."><?= $object->comment ?></textarea>
    </p>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>