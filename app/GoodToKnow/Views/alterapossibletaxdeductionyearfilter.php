<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Edit a Tax Deduction</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Tax Deduction?</p>
        <section>
            <?php foreach ($g->array as $object): ?>
                <a href="/ax1/alter_a_possible_tax_deduction_edit/page/<?= $object->id ?>"
                   class="choose"><?= $object->label ?> [<?= $object->year_paid ?>]</a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>