<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/GiveComsChoicesProcessor/page" method="post">
    <h2>Possible Communities To Add For User</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>The presented choices are communities which the user does Not yet have membership in.</p>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($coms_user_does_not_belong_to as $key => $value): ?>
        <label class="checkbox">
            <input type="checkbox" name="choice-<?php echo $key + 1; ?>" value="<?= $value->id ?>">
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
