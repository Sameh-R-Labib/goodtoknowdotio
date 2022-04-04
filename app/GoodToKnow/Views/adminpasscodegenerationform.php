<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/admin_pass_code_gen_form_processor/page" method="post">
        <h1>Create Account for Someone</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which community do I want this user to become a member of?</p>
        <section>
            <?php foreach ($g->community_array as $key => $value): ?>
                <label for="choice-<?= $key + 1 ?>" class="radio">
                    <input type="radio" id="choice-<?= $key + 1 ?>" name="choice" value="<?= $value->id ?>">
                    <?= $value->community_name ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>