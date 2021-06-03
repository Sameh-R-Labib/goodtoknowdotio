<?php global $app_state; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/DefaultCommunityProcessor/page" method="post">
        <h2>Change Default Community</h2>
        <p>Which of your communities do you want to be the default?</p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($app_state->special_community_array as $key => $value): ?>
                <label for="choice-<?= $key ?>" class="radio">
                    <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                    <?= $value ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>