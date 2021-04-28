<?php global $special_post_array; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/CreateNewPostIPProcessor/page" method="post">
        <h2>Where to put the new post?</h2>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <label for="relate" class="dropdown">Put it
                <select id="relate" name="relate">
                    <option value="after">after</option>
                    <option value="before">before</option>
                </select>
            </label>
        </section>
        <section>
            <?php foreach ($special_post_array as $key => $value): ?>
                <label for="choice-<?= $key ?>" class="radio">
                    <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                    <?= $value ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>