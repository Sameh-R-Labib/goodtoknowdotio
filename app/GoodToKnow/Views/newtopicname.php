<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/new_topic_name_processor/page" method="post">
        <h1>Create Topic</h1>
        <p class="tooltip">ⅈ
            <span class="tooltiptext tooltip-top">⚠️ both fields required ✅ emoji</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="name">Name: </label>
            <input id="name" name="topic_name" type="text" value="" required minlength="1" maxlength="200"
                   size="61" spellcheck="false">
        </p>
        <p>
            <label for="description">Description: </label>
            <input id="description" name="topic_description" type="text" value="" required minlength="1"
                   maxlength="230" size="60" spellcheck="false">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>