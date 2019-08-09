<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/NewTopicNameProcessor/page" method="post">
    <h1>Create Topic</h1>
    <h2>Name and description of topic</h2>
    <p>⚠️ both fields required ✅ emoji.</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <p>
            <label for="name">Name: </label>
            <input id="name" name="topic_name" type="text" value="" required minlength="1" maxlength="200"
                   size="67" spellcheck="false">
        </p>
        <p>
            <label for="description">Description: </label>
            <input id="description" name="topic_description" type="text" value="" required minlength="1"
                   maxlength="230" size="67" spellcheck="false">
        </p>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>