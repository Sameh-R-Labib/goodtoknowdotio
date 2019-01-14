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
<form action="/ax1/GiveComsChoicesProcessor/page" method="post">
    <h2>Possible Communities To Add For User</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>The presented choices are communities which the user does Not yet have membership in.</p>
    <section>
        <label>
            <input type="checkbox" name="0" value="3">
            Community for Bash<br>
        </label>
        <label>
            <input type="checkbox" name="1" value="5">
            Community for Mexican Food<br>
        </label>
        <label>
            <input type="checkbox" name="2" value="7">
            Community for LINUX<br>
        </label>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
        </p>
    </section>
</form>
</body>