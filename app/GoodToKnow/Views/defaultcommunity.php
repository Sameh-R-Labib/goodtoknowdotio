<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/DefaultCommunityProcessor/page" method="post">
    <h1>Change Default 🧑🏿‍🤝‍🧑🏽</h1>
    <p>Which of your communities do you want to be the default?</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($special_community_array as $key => $value): ?>
            <label for="choice-<?= $key ?>" class="radio">
                <input type="radio" id="choice-<?= $key ?>" name="choice" value="<?= $key ?>">
                <?= $value ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>