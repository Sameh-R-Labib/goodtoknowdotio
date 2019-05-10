<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="/hiddenradiomessagestooltips/css/style.css">
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
<div class="form-wrapper">
    <h2>Select a post to affect.</h2>
    <?php require SESSIONMESSAGE; ?>
    <form action="/ax1/TransferPostOwnershipGetPost/page" method="post">
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($array_of_post_objects as $key => $post_object): ?>
            <label for="choice-<?php echo $key; ?>">
                <input type="radio" id="choice-<?php echo $key; ?>" name="choice"
                       value="<?php echo $post_object->id; ?>"/>
                <?php /** @noinspection PhpUndefinedVariableInspection */
                echo $post_object->title . " | " . $post_object->extensionfortitle . " [" .
                    $array_of_author_usernames[$key] . " ]"; ?>
            </label>
        <?php endforeach; ?>
        <button type="submit" name="submit" value="Submit">Submit</button>
    </form>
</div> <!-- .form-wrapper -->
<script src="/hiddenradiomessagestooltips/js/index.js"></script>
</body>
</html>