<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/default_community_processor/page" method="post">
        <h2>Change Default Community</h2>
        <?php require SESSIONMESSAGE; ?>
        <p>Which of your communities do you want to be the default?</p>
        <section>
            <?php foreach ($g->special_community_array as $key => $value): ?>
                <label for="choice-<?= $key ?>" class="radio">
                    <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                    <?= $value ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>