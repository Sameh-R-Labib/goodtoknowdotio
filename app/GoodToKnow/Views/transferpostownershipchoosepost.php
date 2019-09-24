<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/TransferPostOwnershipGetPost/page" method="post">
    <h1>Transfer Post Ownership</h1>
    <?php require SESSIONMESSAGE; ?>
    <p>Select the post to be affected.</p>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($array_of_post_objects as $key => $post_object): ?>
            <label for="choice-<?= $key ?>" class="radio">
                <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $post_object->id ?>">
                <?php /** @noinspection PhpUndefinedVariableInspection */
                echo $post_object->title . " | " . $post_object->extensionfortitle . " [" .
                    $array_of_author_usernames[$key] . " ]"; ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>