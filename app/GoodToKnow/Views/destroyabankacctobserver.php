<?php global $g; ?>
<?php require TOPFORFORMPAGES; ?>
    <form>
        <h1>Delete a Bank Account Observer</h1>
        <?php require SESSIONMESSAGE; ?>
        <p>Which Bank Account Observer?</p>
        <section>
            <?php foreach ($g->array_of_objects as $object): ?>
                <a href="/ax1/destroy_a_bank_acct_observer_processor/page/<?= $object->id ?>"
                   class="choose"><?= $object->observer_id ?> who is observing <?= $object->account_id ?></a>
            <?php endforeach; ?>
        </section>
        <?php require ABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>