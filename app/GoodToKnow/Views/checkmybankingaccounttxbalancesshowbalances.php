<?php require TOPOFREGULARPAGE; ?>
<?php require TOPBARDIV; ?>
<!-- communities -->
<div id="communities">
    <p>👪:&nbsp;&nbsp;<?php require COMMUNITIESFORTHISUSER; ?></p>
</div>
<!-- breadcrumbs -->
<div id="breadcrumbs">
    <p><a href="/ax1/Home/page">⛺</a>:&nbsp;&nbsp;<?php require BREADCRUMBS; ?></p>
</div>
<!-- scriptoutput -->
<div id="scriptoutput">
    <div id="leftsodiv">
        <div id="sendtoauthor"><?php require MESSAGETHEAUTHOR; ?></p></div>
        <div id="admindiv">
            <?php require CONTROLPANELLINK; ?>
        </div>
    </div>
    <div id="scriptmessage">
        <?php require SESSIONMESSAGE; ?>
    </div>
</div>
<!-- maincontent -->
<div id="maincontent">
    <h1>Banking Transaction Ledger</h1>
    <h2><?php /** @noinspection PhpUndefinedVariableInspection */
        echo $account->acct_name; ?></h2>
    <p><b>Starting time:</b> <?= $account->start_time ?><br>
        <b>Starting balance:</b> <?= $account->start_balance ?></p>
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
<!-- footerbar -->
<div id="footerbar">
    <p align="center" style="font-size: 1em;">
        <img src="/Gnu-head-30-years-anniversary.svg" style="float:left;height: 32px;width: 32px;margin-top: -6px">
        © 2018 - Sameh Ramzy Labib
        <img src="/2000px-GPLv3_Logo.svg.png"
             height="32" width="70"
             style="float:right;;margin-top: -6px"></p>
</div>
<?php require BOTTOMOFPAGES; ?>