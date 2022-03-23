<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/KommunityDescriptionEditorFormProcessor/page" method="post">
        <h2><?= $g->saved_str01 ?>'s Details</h2>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">🚫 markdown ✅ emoji ✅ line-break 📲️ maximum 230 bytes</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <p>Details of Community to be Edited</p>
        <section>
            <p>
                <label for="name">Name: </label>
                <input id="name" name="community_name" type="text"
                       value="<?= $g->community_object->community_name ?>" required minlength="1" maxlength="200"
                       size="61" spellcheck="false">
            </p>
            <p>
                <label for="description">Description: </label>
                <input id="description" name="community_description" type="text"
                       value="<?= $g->community_object->community_description ?>" required minlength="1"
                       maxlength="230" size="61" spellcheck="false">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>