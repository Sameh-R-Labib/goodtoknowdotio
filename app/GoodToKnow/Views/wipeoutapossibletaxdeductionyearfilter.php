<?php require TOPFORFORMPAGES; ?>
<form action="/ax1/WipeOutAPossibleTaxDeductionDelete/page" method="post">
    <h1>Delete a Possible Tax Deduction</h1>
    <?php require SESSIONMESSAGE; ?>
    <p>Which Possible Tax Deduction?</p>
    <section>
        <?php foreach ($array as $key => $object): ?>
            <label for="c<?= $key ?>" class="radio">
                <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                <b><?= $object->label ?></b> [<?= $object->year_paid ?>]<br>
            </label>
        <?php endforeach; ?>
    </section>
    <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>