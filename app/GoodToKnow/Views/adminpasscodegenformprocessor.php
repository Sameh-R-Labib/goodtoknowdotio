<?php require TOPFORFORMPAGES; ?>
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
        <label for="box1">Description <strong><abbr title="required">*</abbr></strong> (🚫 markdown ✅ emoji ✅
            line-break):
        </label>
        <textarea id="box1" name="comment" rows="5" cols="71" wrap="soft" maxlength="800" spellcheck="false"
                  placeholder="How'd we meet?"></textarea>
    </p>
    <p>
        <label for="date">Today's date (<em>mm/dd/yyyy</em>): </label>
        <input id="date" name="date" type="text" value="" required minlength="10" spellcheck="false">
    </p>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>