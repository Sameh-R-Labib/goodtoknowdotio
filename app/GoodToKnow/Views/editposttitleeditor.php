<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/edit_post_title_editor_processor/page" method="post">
        <h2>Edit Title of Post</h2>
        <p class="tooltip">ⅈ
            <span class="tooltiptext tooltip-top">A title is that which appears in a listing of posts.
        Title extension is metadata.</span>
        </p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <p>
                <label for="title">Main title: </label>
                <input id="title" name="main_title" type="text" value="<?= $g->post_object->title ?>" required
                       minlength="1" maxlength="200" size="60" spellcheck="false">
            </p>
            <p>
                <label for="extension">Title extension: </label>
                <input id="extension" name="title_extension" type="text"
                       value="<?= $g->post_object->extensionfortitle ?>" required minlength="1" maxlength="200"
                       size="60" spellcheck="false">
            </p>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>