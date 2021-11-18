<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/FeatureATaskUpdate/page" method="post">
        <h1>Edit a Task</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="label">Label (✅ emoji): </label>
                <input id="label" name="label" type="text" value="<?= $g->saved_arr01['label'] ?>" required
                       minlength="3"
                       maxlength="264" size="61" spellcheck="false"
                       placeholder="Read GTK.io messages">
            </p>
            <?php require TIMENEXTANDLASTFORMFIELDS; ?>
            <p>
                <label for="cycle_type">Cycle Type (✅ emoji): </label>
                <input id="cycle_type" name="cycle_type" type="text" value="<?= $g->saved_arr01['cycle_type'] ?>"
                       required
                       minlength="3" maxlength="50" size="60" spellcheck="false" placeholder="Daily 🛅">
            </p>
            <p>
                <label for="comment">Comment (🚫 markdown ✅ emoji ✅ line-break): </label>
                <textarea id="comment" name="comment" rows="5" cols="77" wrap="soft" maxlength="800" spellcheck="false"
                          placeholder="Remarks about decision whether to continue this task"><?= $g->saved_arr01['comment'] ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>