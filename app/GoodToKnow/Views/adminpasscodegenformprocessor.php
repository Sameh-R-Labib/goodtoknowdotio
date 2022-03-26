<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/AdminCreateUser/page" method="post">
        <h1>User</h1>
        <?php require SESSIONMESSAGE; ?>
        <h2>Log-in Credentials</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">Two words separated by an underscore.
            The first word (capitalized w/ 4-9 char.) must start with an upper case letter.
            The second word must consist of two digits.</span>
        </p>
        <section>
            <p>
                <label for="name">Username (<em>like Buddy_52</em>:) </label>
                <input id="name" name="username" type="text" value="" required minlength="7" maxlength=12 size=12
                       spellcheck="false">
            </p>
        </section>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">10 to 264 characters, 2 digits, 2 or more non-alpha, 2 or
                more capitals.</span>
        </p>
        <section>
            <p>
                <label for="first_try">Password 1st try: </label>
                <input id="first_try" name="first_try" type="password" value="" required minlength="7"
                       spellcheck="false">
            </p>
            <p>
                <label for="pwd">Password 2nd try: </label>
                <input id="pwd" name="password" type="password" value="" required minlength="7" spellcheck="false">
            </p>
        </section>
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
            <label for="box1">Description <strong><abbr title="required">*</abbr></strong>:
            </label>
            <textarea id="box1" name="comment" rows="5" cols="72" wrap="soft" maxlength="1800" spellcheck="false"
                      placeholder="How'd we meet?"></textarea>
        </p>
        <p>
            <label for="timezone">PHP Time Zone <span class="tooltip">ℹ️<span class="tooltiptext tooltip-top">See
                            <a href="https://www.php.net/manual/en/timezones.php"
                               target="_blank">www.php.net/manual/en/timezones.php</a></span></span>️:
            </label>
            <input id="timezone" name="timezone" type="text" placeholder="America/New_York" value="" required
                   minlength="2" maxlength="60" size="18">
        </p>
        <p>
            <label for="date">Today's date (<em>mm/dd/yyyy</em>): </label>
            <input id="date" name="date" type="text" value="" required minlength="10" spellcheck="false">
        </p>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>