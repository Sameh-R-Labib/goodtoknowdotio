<?php

namespace GoodToKnow\Controllers;

class AnnulABankingAcctForBalances
{
    function page()
    {
        global $g;

        /**
         * Presenting a form for getting the user to tell us
         * which BankingAcctForBalances record he wants to delete.
         * It will present a series of radio buttons to choose from.
         */


        kick_out_loggedoutusers();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_bankingaccountsforbalances.php';

        $g->html_title = 'Which banking_acct_for_balances?';

        require VIEWS . DIRSEP . 'annulabankingacctforbalances.php';
    }
}