<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/RemoveComsChoicesProcessor/page" method="post">
    <h2>Possible Communities To Remove From the User</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>The presented choices are communities which the user currently has membership in.</p>
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
