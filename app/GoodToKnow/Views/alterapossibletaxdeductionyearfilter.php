<?php global $array; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/AlterAPossibleTaxDeductionEdit/page" method="post">
        <h1>Edit a Tax ✍🏽 Off</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which one?</p>
        <section>
            <?php foreach ($array as $key => $object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <?= $object->label ?> [<?= $object->year_paid ?>]<br>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
</form>
<?php require BOTTOMOFPAGES; ?>