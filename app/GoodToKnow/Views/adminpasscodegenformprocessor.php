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
<form action="/ax1/AdminCreateUser/page" method="post">
    <h1>User</h1>
    <?php require SESSIONMESSAGE; ?>
    <h2>Log-in Credentials</h2>
    <p>The rules for the username: Must consist of two words separated by an underscore.
        The first word (capitalized w/ 4-9 char.) must start with an upper case letter.
        The second word must consist of two digits.</p>
    <section>
        <p>
            <label for="name">Username (<em>like Buddy_52</em>:) </label>
            <input id="name" name="username" type="text" value="" required minlength="6" spellcheck="false">
        </p>
        <p>
            <label for="first_try">Password 1st try: </label>
            <input id="first_try" name="first_try" type="password" value="" required minlength="6" spellcheck="false">
        </p>
        <p>
            <label for="pwd">Password 2nd try: </label>
            <input id="pwd" name="password" type="password" value="" required minlength="6" spellcheck="false">
        </p>
    </section>
    <p>Password: 10 to 18 characters, 2 digits, 2 or more non-alpha, 2 or more capitals.</p>
    <h2>Person's Characteristics</h2>
    <p>Title: </p>
    <section>
        <label for="title_1" class="radio">
            <input type="radio" id="title_1" name="title" value="Mr.">
            Mr.<br>
        </label>
        <label for="title_2" class="radio">
            <input type="radio" id="title_2" name="title" value="Mrs.">
            Mrs.
        </label>
    </section>
    <section>
        <label for="race" class="dropdown">Race: <strong><abbr title="required">*</abbr></strong>
            <select id="race" name="race">
                <option value="caucasian-american">Caucasian American</option>
                <option value="caucasian-european">Caucasian European</option>
                <option value="caucasian-african">Caucasian African</option>
                <option value="black-european">Black European</option>
                <option value="black-american">Black American</option>
                <option value="black-african">Black African</option>
                <option value="asian">Asian</option>
                <option value="south-american">South American</option>
                <option value="greek">Greek</option>
                <option value="middle-eastern-christian">Middle Eastern Christian</option>
                <option value="middle-eastern-moslem">Middle Eastern Moslem</option>
                <option value="native-american">Native American</option>
            </select>
        </label>
    </section>
    <p>
        <label for="box1">Description <strong><abbr title="required">*</abbr></strong> (🚫 html 🚫 markdown ✅ emoji ✅
            line breaks):
        </label>
        <textarea id="box1" name="comment" rows="5" cols="71" wrap="soft" maxlength="800"
                  placeholder="How'd we meet?"></textarea>
    </p>
    <p>
        <label for="date">Today's date (<em>USA mm/dd/yyyy</em>): </label>
        <input id="date" name="date" type="text" value="" required minlength="10" spellcheck="false">
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