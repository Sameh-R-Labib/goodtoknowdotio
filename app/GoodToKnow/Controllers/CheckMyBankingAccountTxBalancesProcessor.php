<?php

namespace GoodToKnow\Controllers;

class CheckMyBankingAccountTxBalancesProcessor
{
    function page()
    {
        /**
         * 1) Store the submitted banking_acct_for_balances record id in the session.
         * 2) Retrieve the banking_acct_for_balances object with that id from the database.
         * 3) Redirect to next piece of code.
         */

        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingaccountforbalances.php';


        /**
         * 3) Redirect to next piece of code.
         */

        redirect_to("/ax1/CheckMyBankingAccountTxBalancesShowBalances/page");
    }
}