<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/purge_old_messages_processor/page" method="post">
    <h1>Purge Old Messages</h1>
    <p class="tooltip">ⅈ
        <span class="tooltiptext tooltip-top">Enter a date. All messages sent before the zero hour (12am) of that date
            will be deleted.</span>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="date">Date (mm/dd/yyyy): </label>
            <input id="date" name="date" type="text" required minlength="10" maxlength="14" size="14"
                   spellcheck="false">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
