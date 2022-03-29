<?php

namespace GoodToKnow\Controllers;

class check_my_banking_account_tx_balances_processor
{
    function page()
    {
        /**
         * 1) Store the submitted banking_acct_for_balances record id in the session.
         * 2) Retrieve the banking_acct_for_balances object with that id from the database.
         * 3) Make sure that object belongs to the user.
         * 4) Redirect to next piece of code.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingaccountforbalances.php';


        /**
         * 4) Redirect to next piece of code.
         */

        redirect_to("/ax1/check_my_banking_account_tx_balances_show_balances/page");
    }
}