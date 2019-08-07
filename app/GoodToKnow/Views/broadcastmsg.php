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
<form action="/ax1/BroadcastMsgProcessor/page" method="post">
    <h2><a href="https://michelf.ca/projects/php-markdown/extra/" target="_blank">📒 Markdown</a></h2>
    <?php require SESSIONMESSAGE; ?>
    <p>
        <small>🚩: ✅ markdown ✅ emoji ⚖️ max. 1500 bytes.<br>
            🔏: ✅ GPG encrypt message w/ receiving user's pub key.
        </small>
    </p>
    <?php require URLOFMOSTRECENTUPLOAD; ?>
    <section>
        <p>
            <label for="textarea"></label>
            <textarea id="textarea" spellcheck="false" name="markdown" rows="27" cols="71"
                      wrap="soft"><?= $pre_populate ?></textarea>
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