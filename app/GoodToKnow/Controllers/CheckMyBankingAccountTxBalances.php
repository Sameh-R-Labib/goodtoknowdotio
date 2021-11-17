<?php

namespace GoodToKnow\Controllers;

class CheckMyBankingAccountTxBalances
{
    function page()
    {
        /**
         * About this feature:
         *  CheckMyBankingAccountTxBalances is a feature for  showing you a ledger with balances for one of
         *  your banking accounts and its transactions.
         *
         * About this function:
         *  It will present to you a selection of your banking  accounts so you can choose one.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_bankingaccountsforbalances.php';


        $g->html_title = 'Which banking account for balances?';


        require VIEWS . DIRSEP . 'checkmybankingaccounttxbalances.php';
    }
}