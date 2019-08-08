<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/AdminPassCodeGenFormProcessor/page" method="post">
    <h2>Create Account</h2>
    <?php require SESSIONMESSAGE; ?>
    <p>Which community do I want this user to become a member of?</p>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($community_array as $key => $value): ?>
            <label for="choice-<?= $key + 1 ?>" class="radio">
                <input type="radio" id="choice-<?= $key + 1 ?>" name="choice" value="<?= $value->id ?>">
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