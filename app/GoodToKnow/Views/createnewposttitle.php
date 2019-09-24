<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/CreateNewPostTitleProcessor/page" method="post">
        <h2>Create a title</h2>
        <?php require SESSIONMESSAGE; ?>
        <p class="tooltip">ℹ️
            <span class="tooltiptext tooltip-top">The main title is the title which will appear in a listing of posts for a topic.
        The title extension is like meta data (It will be added to the main title when the post title is displayed
        outside the context of a specific topic). An example of a main title is
        'Pronouns'. And its extension is "in the Greek Language". ✅ emoji. Both fields required</span>
        </p>
        <section>
            <p>
                <label for="title">Main title: </label>
                <input id="title" name="main_title" type="text" value="" required minlength="1" maxlength="200"
                       size="60" spellcheck="false">
            </p>
            <p>
                <label for="extension">Title extension: </label>
                <input id="extension" name="title_extension" type="text" value="" required minlength="1" maxlength="200"
                       size="60" spellcheck="false">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>