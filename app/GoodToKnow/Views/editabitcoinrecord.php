<?php require TOPFORFORMPAGES; ?>
<?php global $g; ?>
    <form action="/ax1/EditABitcoinRecordProcessor/page" method="post">
        <h1>Edit a ₿ 📽</h1>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php foreach ($g->array_of_bitcoin_objects as $key => $bitcoin_object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $bitcoin_object->id ?>">
                    <?= $bitcoin_object->address ?>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>