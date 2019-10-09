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
        echo "<a href=\"/ax1/BitcoinSeeMyRecords/page\">All Bitcoin Records</a>";
        break;
    case 'About':
        echo "What is this site?";
        break;
    case 'RecurringPaymentSeeMyRecords':
        echo "<a href=\"/ax1/RecurringPaymentSeeMyRecords/page\">Recurring Payments</a>";
        break;
    case 'ViewAllBankingAccountsForBalances':
        echo "<a href=\"/ax1/ViewAllBankingAccountsForBalances/page\">All Bank Accounts</a>";
        break;
    case 'CheckMyBankingAccountTxBalances':
        echo "<a href=\"/ax1/CheckMyBankingAccountTxBalances/page\">Account Balances</a>";
        break;
    case 'SeeOneYearsPossibleTaxDeductions':
        echo "<a href=\"/ax1/SeeOneYearsPossibleTaxDeductions/page\">One Years Deductions</a>";
        break;
    case 'GlanceAtMyTasks':
        echo "<a href=\"/ax1/GlanceAtMyTasks/page\">All Tasks</a>";
        break;
    case 'GawkAtAllTaxableIncomeEvents':
        echo "<a href=\"/ax1/GawkAtAllTaxableIncomeEvents/page\">One Year's Taxable Events</a>";
        break;
    case 'SpyCommoditiesSoldYear':
        echo "<a href=\"/ax1/SpyCommoditiesSold/page\">One Year's Commodities Sold</a>";
        break;
    case 'CPBasics':
        echo "<a href=\"/ax1/CPBasics/page\">Basics</a>";
        break;
    case 'CPTransactions':
        echo "<a href=\"/ax1/CPTransactions/page\">Transactions</a>";
        break;
    default:
        require CURRENTCOMMUNITY;
        require CURRENTTOPIC;
        require CURRENTPOST;
}
