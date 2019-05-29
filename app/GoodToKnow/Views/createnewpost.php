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
    <title><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $html_title; ?></title>
</head>
<body>
<form action="/ax1/CreateNewPostProcessor/page" method="post">
    <h2>Create New Post</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>These are topics in current community.</p>
    <p>Which topic is for the new post?</p>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($special_topic_array as $key => $value): ?>
            <label for="choice-<?php echo $key; ?>" class="radio">
                <input type="radio" id="choice-<?php echo $key; ?>" name="choice" value="<?php echo $key; ?>">
                <?php echo $value; ?><br>
            </label>
        <?php endforeach; ?>
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