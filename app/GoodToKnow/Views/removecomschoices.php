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
    <section>
        <p>
            <button type="submit" name="submit" value="Submit">Submit</button>
            <button type="submit" name="abort" value="Abort" class="abort">Abort</button>
        </p>
    </section>
</form>
<?php require BOTTOMOFPAGES; ?>
