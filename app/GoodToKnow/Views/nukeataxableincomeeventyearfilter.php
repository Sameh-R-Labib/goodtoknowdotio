<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Delete a Taxable Income Event</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Taxable Income Event?</p>
        <section>
            <?php foreach ($g->array as $object): ?>
                <a href="/ax1/nuke_a_taxable_income_event_delete/page/<?= $object->id ?>" class="choose">
                    <b><?= $object->label ?></b> [<?= $object->time ?>]</a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>