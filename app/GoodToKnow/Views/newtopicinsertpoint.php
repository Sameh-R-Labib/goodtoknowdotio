<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
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
    <h2>Where to put the new post?</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>It is recommended that you change communities and come back to the current one to make sure you have a complete
        set of the topics. If you can't do that then at least log out and log back in.</p>
    <form action="/ax1/NewTopicIPProcessor/page" method="post">
        <div>Put it
            <select id="relate" name="relate">
                <option value="after">after</option>
                <option value="before">before</option>
            </select>
        </div>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($special_topic_array as $key => $value): ?>
            <label for="choice-<?php echo $key; ?>">
                <input type="radio" id="choice-<?php echo $key; ?>" name="choice"
                       value="<?php echo $key; ?>"/>
                <?php echo $value; ?>
            </label>
        <?php endforeach; ?>
        <button type="submit" name="submit" value="Submit">Submit</button>
    </form>
</div> <!-- .form-wrapper -->
<script src="/hiddenradiomessagestooltips/js/index.js"></script>
</body>
</html>