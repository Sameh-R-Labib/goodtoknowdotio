<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/KommunityDescriptionEditorFormProcessor/page" method="post">
    <h2><?= $saved_str01 ?> Description</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>
        <small>🚫 markdown 🚫 html ✅ emoji ✅ line-break ⚖️ max. 230 bytes.</small>
    </p>
    <section>
        <p>
            <label for="textarea"></label>
            <textarea id="textarea" spellcheck="false" name="text" rows="12"
                      cols="71" wrap="soft" maxlength="230"><?php /** @noinspection PhpUndefinedVariableInspection */
                echo $community_object->community_description; ?></textarea>
        </p>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>