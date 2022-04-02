<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/topic_description_editor_form_processor/page" method="post">
        <h2>Edit The "<?= $g->saved_str01 ?>" Topic</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">🚫 markdown ✅ emoji ✅ line-break<br>📲️ maximum 230 bytes
                ⚠️ both fields required.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="name">Name: </label>
                <input id="name" name="topic_name" type="text" value="<?= $g->topic_object->topic_name ?>" required
                       minlength="1" maxlength="200" size="61" spellcheck="false">
            </p>
            <p>
                <label for="description">Description: </label>
                <input id="description" name="topic_description" type="text"
                       value="<?= $g->topic_object->topic_description ?>" required minlength="1"
                       maxlength="230" size="60" spellcheck="false">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>