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


        global $app_state;


        require CONTROLLERINCLUDES . DIRSEP . 'get_bankingaccountsforbalances.php';


        $app_state->html_title = 'Which banking account for balances?';


        require VIEWS . DIRSEP . 'checkmybankingaccounttxbalances.php';
    }
}