<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/create_new_post_title_processor/page" method="post">
        <h2>Create a title</h2>
        <p class="tooltip">ⅈ
            <span class="tooltiptext tooltip-top">The main title is the title which appears in a listing of posts for topic.
        While title extension is metadata.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
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