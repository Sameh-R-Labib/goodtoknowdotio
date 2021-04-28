<?php global $array_of_post_objects; ?>
<?php global $array_of_author_usernames; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/QuickPostDeleteDelete/page" method="post">
    <h1>Delete a Post</h1>
    <?php require SESSIONMESSAGE; ?>
    <p>Which post do you want to delete?</p>
    <section>
        <?php foreach ($array_of_post_objects as $key => $post_object): ?>
            <label for="choice-<?= $key ?>" class="radio">
                <input type="radio" id="choice-<?= $key ?>" name="choice"
                       value="<?= $post_object->id ?>">
                <?php echo $post_object->title . " | " . $post_object->extensionfortitle . " [" .
                    $array_of_author_usernames[$key] . " ]"; ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
