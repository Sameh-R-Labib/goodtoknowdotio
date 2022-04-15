<?php require TOPFORFORMPAGES; ?>
<?php global $g; ?>
    <form action="/ax1/balance_out_the_sequence_numbers_form_processor/page" method="post">
        <h2>Adjust Sequence Numbers</h2>
        <?php require SESSIONMESSAGE; ?>
        <p><b><?= $g->thing_type ?>:</b> <?= $g->thing_name ?></p>
        <p><b>range:</b> 0 - 40000000</p>
        <section>
            <?= $g->fields ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>