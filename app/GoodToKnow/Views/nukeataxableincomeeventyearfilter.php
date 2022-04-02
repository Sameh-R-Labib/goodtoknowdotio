<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form action="/ax1/nuke_a_taxable_income_event_delete/page" method="post">
        <h1>Delete a Taxable Income Event</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Taxable Income Event?</p>
        <section>
            <?php foreach ($g->array as $key => $object): ?>
                <label for="c<?= $key ?>" class="radio">
                    <input type="radio" id="c<?= $key ?>" name="choice" value="<?= $object->id ?>">
                    <b><?= $object->label ?></b> [<?= $object->time ?>]<br>
                </label>
            <?php endforeach; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>