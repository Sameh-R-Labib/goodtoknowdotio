<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Move A Post to A Different Topic</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Move which post?</p>
        <section>
            <?php foreach ($g->array_of_post_objects as $post_object): ?>
                <a href="/ax1/move_post_get_post/page/<?= $post_object->id ?>"
                   class="choose"><?= $post_object->title . " | " . $post_object->extensionfortitle ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>