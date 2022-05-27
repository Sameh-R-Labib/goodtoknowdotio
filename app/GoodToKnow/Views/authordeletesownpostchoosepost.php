<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h2>Which post do you want to delete?</h2>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->special_post_array as $key => $value): ?>
                <a href="/ax1/author_deletes_own_post_delete/page/<?= $key ?>"
                   class="choose"><?= $value ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>