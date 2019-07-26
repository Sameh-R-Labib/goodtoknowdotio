<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/editor.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title><?= $html_title ?></title>
</head>
<body>
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
        <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800"
                  placeholder="This banking account is my _ _ _ _ bank's _ _ _ _ account."><?= $object->comment ?></textarea>
    </p>
    <section>
        <p>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
            <button type="submit" name="submit" value="Submit">Submit</button>
        </p>
    </section>
</form>
</body>
</html>