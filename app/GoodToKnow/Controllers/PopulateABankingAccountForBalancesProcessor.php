<?php

namespace GoodToKnow\Controllers;

class PopulateABankingAccountForBalancesProcessor
{
    function page()
    {
        /**
         * 1) Store the submitted banking_acct_for_balances record id in the session.
         * 2) Retrieve the banking_acct_for_balances object with that id from the database.
         * 3) Make sure this object belongs to the user.
         * 4) Present a form which is populated with data from the banking_acct_for_balances object.
         */


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingaccountforbalances.php';


        /**
         * 4) Present a form which is populated with data from the banking_acct_for_balances object.
         */

        $html_title = 'Edit the banking_acct_for_balances record';

        require VIEWS . DIRSEP . 'populateabankingaccountforbalancesprocessor.php';
    }
}