<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/QuickPostDeleteDelete/page" method="post">
    <h2>Which post do you want to delete?</h2>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($array_of_post_objects as $key => $post_object): ?>
            <label for="choice-<?= $key ?>" class="radio">
                <input type="radio" id="choice-<?= $key ?>" name="choice"
                       value="<?= $post_object->id ?>">
                <?php /** @noinspection PhpUndefinedVariableInspection */
                echo $post_object->title . " | " . $post_object->extensionfortitle . " [" .
                    $array_of_author_usernames[$key] . " ]"; ?>
            </label>
        <?php endforeach; ?>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>
