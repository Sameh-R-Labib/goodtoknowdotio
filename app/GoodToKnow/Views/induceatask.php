<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/InduceATaskCreate/page" method="post">
    <h1>Create a To-do Task/💪</h1>
    <h2>Initialize the task record</h2>
    <p>
        <small>✅ emoji for the label.</small>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="label">To Do Task/💪 Label: </label>
            <input id="label" name="label" type="text" value="" required minlength="3" maxlength="264"
                   size="61" spellcheck="false" placeholder="Example ... Read my app's messages">
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