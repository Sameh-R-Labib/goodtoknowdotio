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
<form action="/ax1/FeatureATaskUpdate/page" method="post">
    <h2><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $object->label; ?></h2>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="label">To-do Task/💪️ Label (✅ emoji): </label>
            <input id="label" name="label" type="text" value="<?= $object->label ?>" required minlength="3"
                   maxlength="264" size="61" spellcheck="false"
                   placeholder="Something I need to keep doing.">
        </p>
        <p>
            <label for="last">Unix time at last execution of the task: </label>
            <input id="last" name="last" type="text"
                   value="<?= $object->last ?>" minlength="10" maxlength="22"
                   size="22" placeholder="1560190617">
        </p>
        <p>
            <label for="next">Next scheduled unix time for execution of the task: </label>
            <input id="next" name="next" type="text"
                   value="<?= $object->next ?>" minlength="10" maxlength="22"
                   size="22" placeholder="1560190617">
        </p>
        <p>
            <label for="cycle_type">Cycle Type: </label>
            <input id="cycle_type" name="cycle_type" type="text" value="<?= $object->cycle_type ?>" required
                   minlength="3" maxlength="60" size="60" spellcheck="false" placeholder="Example: monthly">
        </p>
        <p>
            <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
            <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800"
                      placeholder="Possibly some remarks related to decision whether to continue doing this
                       task"><?= $object->comment ?></textarea>
        </p>
    </section>
    <section>
        <p>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
            <button type="submit" name="submit" value="Submit">Submit</button>
        </p>
    </section>
</form>
</body>
</html>