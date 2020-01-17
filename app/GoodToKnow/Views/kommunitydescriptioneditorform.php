<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/KommunityDescriptionEditorFormProcessor/page" method="post">
        <h1><?= $saved_str01 ?> Description</h1>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">🚫 markdown ✅ emoji ✅ line-break 📲️ maximum 230 bytes</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="textarea"></label>
                <textarea id="textarea" spellcheck="false" name="text" rows="43""
                cols="92" wrap="soft"
                maxlength="230"><?php /** @noinspection PhpUndefinedVariableInspection */
                    echo $community_object->community_description; ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>