<?php global $coms_user_belongs_to; ?>
<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/RemoveComsChoicesProcessor/page" method="post">
    <h1>Remove Communities From the User</h1>
    <p class="tooltip">ℹ️
        <span class="tooltiptext tooltip-top">The presented choices are communities which the user currently has
            membership in.</span>
    </p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($coms_user_belongs_to as $key => $value): ?>
            <label class="checkbox">
                <input type="checkbox" name="choice-<?= $key + 1 ?>" value="<?= $value->id ?>">
                <?= $value->community_name ?>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>
