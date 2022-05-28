<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Edit a Possible Income Event</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Taxable Income Event?</p>
        <section>
            <?php foreach ($g->array as $object): ?>
                <a href="/ax1/write_over_a_taxable_income_event_edit/page/<?= $object->id ?>" class="choose">
                    <b><?= $object->label ?></b> [<?= $object->time ?>]</a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>