<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/wipe_out_a_possible_tax_deduction_delete/page" method="post">
        <h1>Delete a Possible Tax Deduction</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Possible Tax Deduction?</p>
        <section>
            <?php foreach ($g->array as $key => $object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <b><?= $object->label ?></b> [<?= $object->year_paid ?>]<br>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>