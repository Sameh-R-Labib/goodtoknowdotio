<?php require TOPFORFORMPAGES; ?>
<?php global $g; ?>
    <form action="/ax1/BalanceOutTheSequenceNumbersFormProcessor/page" method="post">
        <h2>Adjust Sequence Numbers</h2>
        <p><b><?= $g->thing_type ?>:</b> <?= $g->thing_name ?></p>
        <p><b>Range:</b> 0 - 40000000</p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php echo $g->fields; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>