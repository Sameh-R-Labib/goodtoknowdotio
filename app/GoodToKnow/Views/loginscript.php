<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/login_script_processor/page" method="post">
        <h1>You Must Agree To The Terms of Service</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <label class="checkbox">
                <input type="checkbox" required name="choice" value="agree">
                I have read and I agree to the <a class="no-frills-link" href="/ax1/proclamation/page">Terms
                    Of Service</a>.
            </label>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>