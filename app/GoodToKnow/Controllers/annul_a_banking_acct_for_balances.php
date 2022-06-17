<?php

namespace GoodToKnow\Controllers;

class annul_a_banking_acct_for_balances
{
    function page()
    {
        global $g;

        /**
         * Presenting a form for getting the user to tell us
         * which banking_acct_for_balances record he / she wants to delete.
         * It will present a series of buttons to choose from.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        // This flag helps with avoid a premature breakout() in get_bankingaccountsforbalances.php
        // when used in check_my_banking_account_tx_balances.
        $g->is_show_bank_account_transactions = false;


        require CONTROLLERINCLUDES . DIRSEP . 'get_bankingaccountsforbalances.php';

        $g->html_title = 'Which banking_acct_for_balances?';

        require VIEWS . DIRSEP . 'annulabankingacctforbalances.php';
    }
}