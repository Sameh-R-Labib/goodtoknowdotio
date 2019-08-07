<?php

switch ($page) {
    case 'Inbox':
        echo "<a href=\"/ax1/Inbox/page\">Inbox</a>";
        break;
    case 'Admin':
        echo "<a href=\"/ax1/AdminHome/page\">Admin Home</a>";
        break;
    case 'CP':
        echo "<a href=\"/ax1/ControlPanel/page\">Control Panel</a>";
        break;
    case 'UserRoster':
        echo "<a href=\"/ax1/UserRoster/page\">User Roster</a>";
        break;
    case 'BitcoinSeeMyRecords':
        echo "<a href=\"/ax1/BitcoinSeeMyRecords/page\">My Bitcoin Records</a>";
        break;
    case 'About':
        echo "What is this site?";
        break;
    case 'RecurringPaymentSeeMyRecords':
        echo "<a href=\"/ax1/RecurringPaymentSeeMyRecords/page\">My Recurring Payments</a>";
        break;
    case 'ViewAllBankingAccountsForBalances':
        echo "<a href=\"/ax1/ViewAllBankingAccountsForBalances/page\">View All Banking Accounts For Balances</a>";
        break;
    case 'CheckMyBankingAccountTxBalances':
        echo "<a href=\"/ax1/CheckMyBankingAccountTxBalances/page\">Check My Banking Account Transactions For Balances</a>";
        break;
    case 'SeeOneYearsPossibleTaxDeductions':
        echo "<a href=\"/ax1/SeeOneYearsPossibleTaxDeductions/page\">See One Years Possible Deductions</a>";
        break;
    case 'GlanceAtMyTasks':
        echo "<a href=\"/ax1/GlanceAtMyTasks/page\">See My To-do Tasks</a>";
        break;
    case 'GawkAtAllTaxableIncomeEvents':
        echo "<a href=\"/ax1/GawkAtAllTaxableIncomeEvents/page\">See One Years Taxable Income Events</a>";
        break;
    default:
        require CURRENTCOMMUNITY;
        require CURRENTTOPIC;
        require CURRENTPOST;
}
