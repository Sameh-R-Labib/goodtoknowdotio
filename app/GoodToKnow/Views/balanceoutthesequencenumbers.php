<?php require TOPFORFORMPAGES; ?>
<?php global $thing_type; ?>
<?php global $thing_name; ?>
<?php global $result; ?>
<?php global $fields; ?>
    <form action="/ax1/BalanceOutTheSequenceNumbersFormProcessor/page" method="post">
        <h2>Adjust Sequence Numbers</h2>
        <p><b><?= $thing_type ?>:</b> <?= $thing_name ?></p>
        <p><b>Range:</b>b> 0 - 40000000</p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <?php echo $fields; ?>
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>