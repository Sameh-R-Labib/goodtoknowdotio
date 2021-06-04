<?php global $app_state; ?>
<?php global $community_object; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/KommunityDescriptionEditorFormProcessor/page" method="post">
        <h2><?= $app_state->saved_str01 ?> Description</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">🚫 markdown ✅ emoji ✅ line-break 📲️ maximum 230 bytes</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="textarea"></label>
                <textarea id="textarea" spellcheck="false" name="text" rows="28"
                          cols="77" wrap="soft"
                          maxlength="230"><?php echo $community_object->community_description; ?></textarea>
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>