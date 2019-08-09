<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/MemberMemEdFormProc/page" method="post">
    <h2><?= $saved_str01 ?> Memo</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>
        <small>🚫 markdown 🚫 html ✅ emoji ✅ line-break ⚖️ max. 800 bytes.</small>
    </p>
    <section>
        <p>
            <label for="textarea"></label>
            <textarea id="textarea" spellcheck="false" name="text" rows="29"
                      cols="71" wrap="soft" maxlength="800"><?php /** @noinspection PhpUndefinedVariableInspection */
                echo $user_object->comment; ?></textarea>
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>