<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
<?php global $g; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1><?= $g->account->acct_name ?></h1>
        <p><b>Starting time: </b><?= $g->account->start_time ?><br>
            <b>Starting balance: </b><?= $g->account->currency ?>&nbsp;<?= $g->account->start_balance ?>
            <span class="tooltip">ⅈ
                        <span class="tooltiptext tooltip-top">Incorrect if Admin purged transactions
                            older than 90 days and start_time older than 90.</span>
                    </span><br>
            <b>Comment: </b><?= $g->account->comment ?></p>
        <p><a class="clearbtn" href="/ax1/build_a_banking_transaction_for_balances/page">Create Transaction</a></p>
        <table>
            <tr>
                <th>time</th>
                <th>label</th>
                <th>amount</th>
                <th>balance</th>
            </tr>
            <?php foreach ($g->array as $transaction): ?>
                <tr>
                    <td><?= $transaction->time ?></td>
                    <td class='alnright'><?= $transaction->label ?></td>
                    <td class='alnright'><?= $transaction->amount ?></td>
                    <td class='alnright'><?= $transaction->balance ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>