<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/DefaultCommunityProcessor/page" method="post">
    <h2>Switch Default Community</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>Which of my communities do I want to be the default?</p>
    <section>
        <?php foreach ($special_community_array as $key => $value): ?>
            <label for="choice-<?= $key ?>" class="radio">
                <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                <?= $value ?>
            </label>
        <?php endforeach; ?>
    </section>
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>