<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/PurgeOldMessagesProcessor/page" method="post">
    <h2>Purge Old Messages</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>Enter a date (to be used as a time). The assumption is that all messages sent before the zero hour (12am) of that
        date will be deleted.</p>
    <section>
        <p>
            <label for="date">Date (USA mm/dd/yyyy): </label>
            <input id="date" name="date" type="text" required minlength="10" maxlength="10" size="10"
                   spellcheck="false">
        </p>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>
