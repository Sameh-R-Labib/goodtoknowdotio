<?php

namespace GoodToKnow\Controllers;

class populate_a_banking_account_for_balances
{
    function page()
    {
        /**
         * This feature is for editing/updating a banking_acct_for_balances record.
         *
         * This route is for presenting a form for getting the user to tell us which banking_acct_for_balances
         * record he wants to edit. It will present a series of radio buttons to choose from.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        // This flag helps with avoid a premature breakout() in get_bankingaccountsforbalances.php
        // when used in check_my_banking_account_tx_balances.
        $g->is_show_bank_account_transactions = false;


        require CONTROLLERINCLUDES . DIRSEP . 'get_bankingaccountsforbalances.php';


        $g->html_title = 'Which banking_acct_for_balances record?';


        require VIEWS . DIRSEP . 'populateabankingaccountforbalances.php';
    }
}