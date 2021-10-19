<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/TopicDescriptionEditorFormProcessor/page" method="post">
        <h2><?= $g->saved_str01 ?> Description</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">🚫 markdown ✅ emoji ✅ line-break 📲️ maximum 230 bytes.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="textarea"></label>
                <textarea id="textarea" spellcheck="false" name="text" rows="28"
                          cols="77" wrap="soft"
                          maxlength="230"><?= $g->topic_object->topic_description ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>