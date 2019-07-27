<?php

if ($page === 'Inbox') echo "<a href=\"/ax1/Inbox/page\">Inbox</a>";
elseif ($page === 'Admin') echo "<a href=\"/ax1/AdminHome/page\">Admin Home</a>";
elseif ($page === 'CP') echo "<a href=\"/ax1/ControlPanel/page\">Control Panel</a>";
elseif ($page === 'UserRoster') echo "<a href=\"/ax1/UserRoster/page\">User Roster</a>";
elseif ($page === 'BitcoinSeeMyRecords') echo "<a href=\"/ax1/BitcoinSeeMyRecords/page\">My Bitcoin Records</a>";
elseif ($page === 'About') echo "What is this site?";
elseif ($page === 'RecurringPaymentSeeMyRecords') echo "<a href=\"/ax1/RecurringPaymentSeeMyRecords/page\">My Recurring Payments</a>";
elseif ($page === 'ViewAllBankingAccountsForBalances')
    echo "<a href=\"/ax1/ViewAllBankingAccountsForBalances/page\">View All Banking Accounts For Balances</a>";
elseif ($page === 'CheckMyBankingAccountTxBalances')
    echo "<a href=\"/ax1/CheckMyBankingAccountTxBalances/page\">Check My Banking Account Transactions For Balances</a>";
elseif ($page === 'SeeOneYearsPossibleTaxDeductions')
    echo "<a href=\"/ax1/SeeOneYearsPossibleTaxDeductions/page\">See One Years Possible Deductions</a>";
elseif ($page === 'GlanceAtMyTasks')
    echo "<a href=\"/ax1/GlanceAtMyTasks/page\">See My To-do Tasks</a>";
else {
    require CURRENTCOMMUNITY;
    require CURRENTTOPIC;
    require CURRENTPOST;
}
