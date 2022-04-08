<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/move_post_get_post/page" method="post">
        <h1>Move Post From Current Topic to Different Topic</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Move which post?</p>
        <section>
            <?php foreach ($g->array_of_post_objects as $key => $post_object): ?>
                <label for="choice-<?= $key ?>" class="radio">
                    <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $post_object->id ?>">
                    <?= $post_object->title . " | " . $post_object->extensionfortitle ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>