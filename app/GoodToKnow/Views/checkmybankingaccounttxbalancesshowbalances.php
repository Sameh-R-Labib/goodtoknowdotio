<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
<?php global $g; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1><?= $g->account->acct_name ?></h1>
        <table class="not_there">
            <col width="92%">
            <col width="10">
            <tr>
                <td><b>Starting time: </b><?= $g->account->start_time ?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><b>Starting balance: </b><?= $g->account->currency ?>&nbsp;<?= $g->account->start_balance ?></td>
                <td><span class="tooltip">ⅈ
                        <span class="tooltiptext tooltip-top">Balance will be incorrect if Admin has purged transactions
                            older than 90 days and the start_time for this account is older than 90 days.</span>
                    </span></td>
            </tr>
            <tr>
                <td><b>Comment: </b><?= $g->account->comment ?></td>
                <td>&nbsp;</td>
            </tr>
        </table>
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
                    <td align="right"><?= $transaction->label ?></td>
                    <td align="right"><?= $transaction->amount ?></td>
                    <td align="right"><?= $transaction->balance ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div><!-- End maincontent -->
<?php require FOOTERBAR; ?>
<?php require BOTTOMOFPAGES; ?>