<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/alter_a_possible_tax_deduction_edit/page" method="post">
        <h1>Edit a Possible Tax Deduction</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which one?</p>
        <section>
            <?php foreach ($g->array as $key => $object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <?= $object->label ?> [<?= $object->year_paid ?>]<br>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>