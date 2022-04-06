<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/login_script_processor/page" method="post">
        <h1>You Must Agree To The Terms of Service</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <label class="checkbox">
                <input type="checkbox" name="choice" value="agree">
                I agree to the terms of service found on the Proclamation page.
            </label>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>