<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/PurgeOldMessagesProcessor/page" method="post">
    <h1>Purge Old 💬s</h1>
    <h2>Purge Old Messages</h2>
    <p>Enter a date (to be used as a time). The assumption is that all messages sent before the zero hour (12am) of that
        date will be deleted.</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="date">Date (USA mm/dd/yyyy): </label>
            <input id="date" name="date" type="text" required minlength="10" maxlength="10" size="10"
                   spellcheck="false">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
