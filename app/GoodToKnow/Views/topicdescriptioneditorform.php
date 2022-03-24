<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/TopicDescriptionEditorFormProcessor/page" method="post">
        <h2><?= $g->saved_str01 ?> Description</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">🚫 markdown ✅ emoji ✅ line-break 📲️ maximum 230 bytes.</span>
            <span class="tooltiptext tooltip-top">⚠️ both fields required ✅ emoji</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <p>Name and description of topic</p>
        <section>
            <p>
                <label for="name">Name: </label>
                <input id="name" name="topic_name" type="text" value="" required minlength="1" maxlength="200"
                       size="61" spellcheck="false">
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