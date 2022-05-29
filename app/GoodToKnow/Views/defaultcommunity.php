<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h2>Change Default Community</h2>
        <?php require SESSIONMESSAGE; ?>
        <p>Which of your communities do you want to be the default?</p>
        <section>
            <?php foreach ($g->special_community_array as $key => $value): ?>
                <a href="/ax1/default_community_processor/page/<?= $key ?>" class="choose"><?= $value ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>