<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/author_deletes_own_post_delete/page" method="post">
        <h2>Which post do you want to delete?</h2>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->special_post_array as $key => $value): ?>
                <label for="choice-<?= $key ?>" class="radio">
                    <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                    <?= $value ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>