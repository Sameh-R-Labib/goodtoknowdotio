<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/give_coms_choices_processor/page" method="post">
    <h1>Add Community To User's Account</h1>
    <p class="tooltip">ℹ️
        <span class="tooltiptext tooltip-top">The presented choices are communities which the user does Not yet have membership in.</span>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($g->coms_user_does_not_belong_to as $key => $value): ?>
            <label class="checkbox">
                <input type="checkbox" name="choice-<?= $key + 1 ?>" value="<?= $value->id ?>">
                <?= $value->community_name ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
