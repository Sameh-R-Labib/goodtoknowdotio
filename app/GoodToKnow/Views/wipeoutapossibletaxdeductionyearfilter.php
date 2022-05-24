<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Delete a Possible Tax Deduction</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Possible Tax Deduction?</p>
        <section>
            <?php foreach ($g->array as $object): ?>
                <a href="/ax1/wipe_out_a_possible_tax_deduction_delete/page/<?= $object->id ?>"
                   class="choose"><?= $object->label ?> [<?= $object->year_paid ?>]</a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>