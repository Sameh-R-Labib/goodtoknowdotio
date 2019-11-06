<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1><?php /** @noinspection PhpUndefinedVariableInspection */
            echo $account->acct_name; ?></h1>
        <table class="not_there">
            <tr>
                <td><b>Starting time: </b><?= $account->start_time ?></td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><b>Starting balance: </b><?= $account->currency ?>&nbsp;<?= $account->start_balance ?></td>
                <td><span class="tooltip">ℹ️
                        <span class="tooltiptext tooltip-top">Balance will be incorrect if admin has purged transactions
                            older than 90 days and the start_time for this account is older than 90 days.</span>
                    </span></td>
            </tr>
        </table>
        <table>
            <tr>
                <th>time</th>
                <th>label</th>
                <th>amount</th>
                <th>balance</th>
            </tr>
            <?php foreach ($array as $transaction): ?>
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