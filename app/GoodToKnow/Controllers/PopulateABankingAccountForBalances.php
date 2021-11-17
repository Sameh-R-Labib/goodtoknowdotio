<?php

namespace GoodToKnow\Controllers;

class PopulateABankingAccountForBalances
{
    function page()
    {
        /**
         * This feature is for editing/updating a BankingAcctForBalances record.
         *
         * This route is for presenting a form for getting the user to tell us which BankingAcctForBalances
         * record he wants to edit. It will present a series of radio buttons to choose from.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_bankingaccountsforbalances.php';


        $g->html_title = 'Which banking_acct_for_balances record?';


        require VIEWS . DIRSEP . 'populateabankingaccountforbalances.php';
    }
}