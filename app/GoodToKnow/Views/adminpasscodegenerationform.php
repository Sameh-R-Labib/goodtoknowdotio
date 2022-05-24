<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Create Account for Someone</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which community do I want this user to become a member of?</p>
        <section>
            <?php foreach ($g->community_array as $key => $value): ?>
                <a href="/ax1/admin_pass_code_gen_form_processor/page/<?= $value->id ?>"
                   class="choose"><?= $value->community_name ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>