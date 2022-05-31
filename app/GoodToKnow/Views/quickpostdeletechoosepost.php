<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form>
    <h1>Delete a Blog Post</h1>
    <?php require SESSIONMESSAGE; ?>
    <p>Which post do you want to delete?</p>
    <section>
        <?php foreach ($g->array_of_post_objects as $key => $post_object): ?>
            <a href="/ax1/quick_post_delete_delete/page/<?= $post_object->id ?>" class="choose">
                <?= $post_object->title . " | " . $post_object->extensionfortitle . " [" .
                $g->array_of_author_usernames[$key] . " ]" ?></a>
        <?php endforeach; ?>
    </section>
    <?php require ABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
