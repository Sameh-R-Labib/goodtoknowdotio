<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/quick_post_delete_delete/page" method="post">
    <h1>Delete a Blog Post</h1>
    <?php require SESSIONMESSAGE; ?>
    <p>Which post do you want to delete?</p>
    <section>
        <?php foreach ($g->array_of_post_objects as $key => $post_object): ?>
            <label for="choice-<?= $key ?>" class="radio">
                <input type="radio" id="choice-<?= $key ?>" name="choice"
                       value="<?= $post_object->id ?>">
                <?= $post_object->title . " | " . $post_object->extensionfortitle . " [" .
                $g->array_of_author_usernames[$key] . " ]" ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
