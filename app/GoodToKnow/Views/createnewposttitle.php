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
<body>
<form action="/ax1/CreateNewPostTitleProcessor/page" method="post">
    <h2>Create a title</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>The main title is the title which will appear in a listing of posts for a topic.
        The title extension is like meta data (It will be added to the main title when the post title is displayed
        outside the context of a specific topic). An example of a main title is
        'Pronouns'. And its extension is "in the Greek Language".</p>
    <p>UTF-8 characters allowed &mdash; 🚫 emoji</p>
    <p>* both required</p>
    <section>
        <p>
            <label for="title">Main title: </label>
            <input id="title" name="main_title" type="text" value="" required minlength="1" maxlength="200"
                   size="67" spellcheck="false">
        </p>
        <p>
            <label for="extension">Title extension: </label>
            <input id="extension" name="title_extension" type="text" value="" required minlength="1" maxlength="200"
                   size="64" spellcheck="false">
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