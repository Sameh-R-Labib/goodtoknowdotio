<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/editor.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $html_title; ?></title>
</head>
<body>
<form action="/ax1/NewCommunityProcessor/page" method="post">
    <h2>Details of Community To Be Created</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>All fields required.</p>
    <section>
        <p>
            <label for="name">Name: </label>
            <input id="name" name="community_name" type="text" required minlength="1" maxlength="200"
                   size="71" spellcheck="false">
        </p>
        <p>
            <label for="description">Description: </label>
            <input id="description" name="community_description" type="text" required minlength="1"
                   maxlength="230" size="71" spellcheck="false">
        </p>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
        </p>
    </section>
</form>
</body>