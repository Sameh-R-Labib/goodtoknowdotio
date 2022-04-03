<?php

namespace GoodToKnow\Controllers;

class check_my_banking_account_tx_balances
{
    function page()
    {
        /**
         * About this feature:
         *  check_my_banking_account_tx_balances is a feature for  showing you a ledger with balances for one of
         *  your banking accounts and its transactions.
         *
         * About this function:
         *  It will present to you a selection of your banking  accounts so you can choose one.
         */


        global $g;


        kick_out_loggedoutusers();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_bankingaccountsforbalances.php';


        $g->html_title = 'Which banking account for balances?';


        require VIEWS . DIRSEP . 'checkmybankingaccounttxbalances.php';
    }
}