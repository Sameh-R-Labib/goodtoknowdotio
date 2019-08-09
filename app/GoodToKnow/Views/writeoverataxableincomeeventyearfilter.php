<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/WriteOverATaxableIncomeEventEdit/page" method="post">
    <h2>Which Taxable Income Event?</h2>
    <?php require SESSIONMESSAGE; ?>
    <section>
        <?php foreach ($array as $key => $object): ?>
            <label for="c<?= $key ?>" class="radio">
                <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                <b><?= $object->label ?></b> [<?= $object->time ?>]<br>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>