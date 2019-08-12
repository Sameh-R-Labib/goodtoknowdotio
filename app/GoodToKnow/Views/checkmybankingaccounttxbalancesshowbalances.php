<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<?php require CBSOFREGULARPAGES; ?>
    <!-- maincontent -->
    <div id="maincontent">
        <h1>Banking Transaction Ledger</h1>
        <h2><?php /** @noinspection PhpUndefinedVariableInspection */
            echo $account->acct_name; ?></h2>
        <p><b>Starting time: </b><?= $account->start_time ?><br>
            <b>Starting balance: </b><?= $account->currency ?>&nbsp;<?= $account->start_balance ?></p>
        <p>The balances will be incorrect if admin has deleted transactions older than 90 days and the start_time for
            the BankingAcctForBalances for these transactions is older than 90 days.</p>
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