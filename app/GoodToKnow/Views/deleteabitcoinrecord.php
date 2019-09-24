<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/DeleteABitcoinRecordProcessor/page" method="post">
    <h1>Delete a ₿ 📽</h1>
    <p>Which Bitcoin Record?</p>
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
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>