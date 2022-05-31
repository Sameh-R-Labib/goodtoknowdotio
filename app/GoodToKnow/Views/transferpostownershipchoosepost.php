<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Transfer Blog Post Ownership</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Select the post to be affected.</p>
        <section>
            <?php foreach ($g->array_of_post_objects as $key => $post_object): ?>
                <a href="/ax1/transfer_post_ownership_get_post/page/<?= $post_object->id ?>" class="choose">
                    <?= $post_object->title . " | " . $post_object->extensionfortitle . " [" .
                    $g->array_of_author_usernames[$key] . " ]" ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>