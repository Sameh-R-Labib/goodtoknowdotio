<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/FeatureATaskUpdate/page" method="post">
    <h1>Edit a To-do Task/💪</h1>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="label">Label (✅ emoji): </label>
            <input id="label" name="label" type="text" value="<?= $object->label ?>" required minlength="3"
                   maxlength="264" size="61" spellcheck="false"
                   placeholder="Read GTK.io messages">
        </p>
        <?php require TIMENEXTANDLASTFORMFIELDSPREFILLED; ?>
        <p>
            <label for="last">Unix time at last execution of the task: </label>
            <input id="last" name="last" type="text"
                   value="<?= $object->last ?>" minlength="10" maxlength="22"
                   size="22" placeholder="1546300800">
        </p>
        <p>
            <label for="next">Next scheduled time: </label>
            <input id="next" name="next" type="text"
                   value="<?= $object->next ?>" minlength="10" maxlength="22"
                   size="22" placeholder="1546300800">
        </p>
        <p>
            <label for="cycle_type">Cycle Type (✅ emoji): </label>
            <input id="cycle_type" name="cycle_type" type="text" value="<?= $object->cycle_type ?>" required
                   minlength="3" maxlength="50" size="60" spellcheck="false" placeholder="Daily 🛅">
        </p>
        <p>
            <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
            <textarea id="comment" name="comment" rows="4" cols="71" wrap="soft" maxlength="800" spellcheck="false"
                      placeholder="Remarks about decision whether to continue this task"><?= $object->comment ?></textarea>
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>