<?php include 'a_form_top.php'; ?>
<?php global $g; ?>
    <section>
        <p>
            <label for="label">Label: </label>
            <input id="label" name="label" type="text" value="<?= $g->saved_arr01['label'] ?>" required
                   minlength="3" maxlength="264" size="61" spellcheck="false" placeholder="Read GTK.io messages">
        </p>
        <?php require TIMENEXTANDLASTFORMFIELDS; ?>
        <p>
            <label for="cycle_type">Cycle Type: </label>
            <input id="cycle_type" name="cycle_type" type="text"
                   value="<?= $g->saved_arr01['cycle_type'] ?>" required minlength="3" maxlength="60"
                   size="50" spellcheck="false" placeholder="Daily 🛅">
        </p>
        <p>
            <label for="comment">Comment: </label>
            <textarea id="comment" name="comment" rows="5" cols="77" wrap="soft" maxlength="1800" spellcheck="false"
                      placeholder="Remarks about decision whether to"><?= $g->saved_arr01['comment'] ?></textarea>
        </p>
    </section>
<?php include 'a_form_bottom.php'; ?>