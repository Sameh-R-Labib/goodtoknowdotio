<?php require TOPFORFORMPAGES; ?>
<?php global $thing_type; ?>
<?php global $thing_name; ?>
    <form action="/ax1/BalanceOutTheSequenceNumbersFormProcessor/page" method="post">
        <h2>Adjust sequence numbers</h2>
        <p><b><?= $thing_type ?>:</b> <?= $thing_name ?></p>
        <p>Sequence numbers have range 0 to 40,000,000.</p>
        <?php require SESSIONMESSAGE; ?>
        <section>
            <!-- Some foreach loop -->
        </section>
        <?php require SUBMITABORT; ?>
    </form>
<?php require BOTTOMOFPAGES; ?>