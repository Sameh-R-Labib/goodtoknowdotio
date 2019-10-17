<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/TopicDescriptionEditorFormProcessor/page" method="post">
    <h2>Topic Description Editor</h2>
    <h2><?= $saved_str01 ?></h2>
    <p class="tooltip">ℹ️
        <span class="tooltiptext tooltip-top">🚫 markdown ✅ emoji ✅ line-break 📲️ maximum 230 bytes.</span>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="textarea"></label>
            <textarea id="textarea" spellcheck="false" name="text" rows="15"
                      cols="79" wrap="soft" maxlength="230"><?php /** @noinspection PhpUndefinedVariableInspection */
                echo $topic_object->topic_description; ?></textarea>
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>