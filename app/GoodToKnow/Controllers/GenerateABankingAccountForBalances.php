<?php

namespace GoodToKnow\Controllers;

class GenerateABankingAccountForBalances
{
    function page()
    {
        /**
         * This feature enables any user to create a database record in the banking_acct_for_balances table.
         * The process will ask the user to ONLY supply a banking_acct_for_balances acct_name and the remaining
         * field values will be supplied by an (not included) editor for the record.
         */

        /**
         * This here script simply presents a form for the user to supply the banking_acct_for_balances
         * acct_name for the "to be created" banking_acct_for_balances record.
         */

        global $sessionMessage;

        global $timezone;

        kick_out_loggedoutusers();

        $html_title = 'Create a New BankingAcctForBalances';

        require VIEWS . DIRSEP . 'generateabankingaccountforbalances.php';
    }
}