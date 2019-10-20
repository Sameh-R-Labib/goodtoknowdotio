<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/MemberMemEdFormProc/page" method="post">
    <h1><?= $saved_str01 ?> Memo</h1>
    <p class="tooltip">ℹ️
        <span class="tooltiptext tooltip-top">🚫 markdown ✅ emoji ✅ line-break 📲️ maximum 800 bytes.</span>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="comment"></label>
            <textarea id="comment" spellcheck="false" name="comment" rows="29"
                      cols="87" wrap="soft" maxlength="800"><?php /** @noinspection PhpUndefinedVariableInspection */
                echo $user_object->comment; ?></textarea>
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>