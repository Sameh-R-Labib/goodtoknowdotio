<?php

global $g;

switch ($g->page) {
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
        echo "<a href=\"/ax1/BitcoinSeeMyRecords/page\">List My Bitcoin Records</a>";
        break;
    case 'About':
        echo "What is this site?";
        break;
    case 'RecurringPaymentSeeMyRecords':
        echo "<a href=\"/ax1/RecurringPaymentSeeMyRecords/page\">See All Recurring Payments</a>";
        break;
    case 'ViewAllBankingAccountsForBalances':
        echo "<a href=\"/ax1/ViewAllBankingAccountsForBalances/page\">Bank Accounts And Their Starting Balances</a>";
        break;
    case 'CheckMyBankingAccountTxBalances':
        echo "<a href=\"/ax1/CheckMyBankingAccountTxBalances/page\">See B. Account</a>";
        break;
    case 'SeeOneYearsPossibleTaxDeductions':
        echo "<a href=\"/ax1/SeeOneYearsPossibleTaxDeductions/page\">1 Year's Tax Write-offs</a>";
        break;
    case 'GlanceAtMyTasks':
        echo "<a href=\"/ax1/GlanceAtMyTasks/page\">All My Tasks</a>";
        break;
    case 'GawkAtAllTaxableIncomeEvents':
        echo "<a href=\"/ax1/GawkAtAllTaxableIncomeEvents/page\">A Year's Taxable Income Events</a>";
        break;
    case 'SpyCommoditiesSoldYear':
        echo "<a href=\"/ax1/SpyCommoditiesSold/page\">One Year's Commodities Sold</a>";
        break;
    case 'CPBasics':
        echo "<a href=\"/ax1/CPBasics/page\">Main ⚙</a>";
        break;
    case 'CPTransactions':
        echo "<a href=\"/ax1/CPTransactions/page\">Bank Account Ledger</a>";
        break;
    case 'CPRecurringPayments':
        echo "<a href=\"/ax1/CPRecurringPayments/page\">Recurring Payments</a>";
        break;
    case 'CPBankingAccounts':
        echo "<a href=\"/ax1/CPBankingAccounts/page\">CRUD For Bank Accounts And Their Starting Balances</a>";
        break;
    case 'CPCrypto':
        echo "<a href=\"/ax1/CPCrypto/page\">Crypto</a>";
        break;
    case 'CPTaxDeductions':
        echo "<a href=\"/ax1/CPTaxDeductions/page\">Tax Write-offs</a>";
        break;
    case 'CPToDoList':
        echo "<a href=\"/ax1/CPToDoList/page\">Tasks</a>";
        break;
    case 'CPTaxableIncome':
        echo "<a href=\"/ax1/CPTaxableIncome/page\">Taxable Income</a>";
        break;
    case 'CPCapitalGains':
        echo "<a href=\"/ax1/CPCapitalGains/page\">Commodities Sold (Enables me to determine capital gains.)</a>";
        break;
    case 'CPPurges':
        echo "<a href=\"/ax1/CPPurges/page\">Purges</a>";
        break;
    case 'CPAccounts':
        echo "<a href=\"/ax1/CPAccounts/page\">Accounts</a>";
        break;
    case 'CPPostings':
        echo "<a href=\"/ax1/CPPostings/page\">Postings</a>";
        break;
    default:
        require CURRENTCOMMUNITY;
        require CURRENTTOPIC;
        require CURRENTPOST;
}
