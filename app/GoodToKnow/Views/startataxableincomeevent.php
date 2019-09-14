<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/StartATaxableIncomeEventProcessor/page" method="post">
    <h1>Create a Taxable 💸 Event 📽</h1>
    <h2>Initialize the Taxable Income Event record with its label and time</h2>
    <p>
        <small>✅ emoji for the label.</small>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="label">Label: </label>
            <input id="label" name="label" type="text" value="" required minlength="3" maxlength="264"
                   size="61" spellcheck="false" placeholder="Support from a Gtk.io User">
        </p>
        <p>
            <label for="year_received">Year for when event occured: </label>
            <input id="year_received" name="year_received" type="text" value="" required minlength="4" maxlength="6"
                   size="6" placeholder="2018">
        </p>
        <p>
            <label for="time">Unix time for when event occured: </label>
            <input id="time" name="time" type="text" value="" required minlength="10" maxlength="22"
                   size="22" placeholder="1560190617">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>