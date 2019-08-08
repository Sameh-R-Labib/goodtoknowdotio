<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/DeleteABitcoinRecordProcessor/page" method="post">
    <h1>Delete a ₿ 📽</h1>
    <h2>Which Bitcoin Record?</h2>
    <p>Listed by bitcoin address.</p>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php /** @noinspection PhpUndefinedVariableInspection */
        foreach ($array_of_bitcoin_objects as $key => $bitcoin_object): ?>
            <label for="c<?= $key ?>" class="radio">
                <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $bitcoin_object->id ?>">
                <?= $bitcoin_object->address ?>
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