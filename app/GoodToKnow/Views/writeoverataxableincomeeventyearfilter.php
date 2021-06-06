<?php global $gtk; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/WriteOverATaxableIncomeEventEdit/page" method="post">
        <h1>Edit a Possible Income Event</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Taxable Income Event?</p>
        <section>
            <?php foreach ($gtk->array as $key => $object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <b><?= $object->label ?></b> [<?= $object->time ?>]<br>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>