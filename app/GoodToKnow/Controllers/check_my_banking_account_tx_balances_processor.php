<?php

namespace GoodToKnow\Controllers;

class check_my_banking_account_tx_balances_processor
{
    function page(int $id = 0)
    {
        /**
         * 1) Store the submitted banking_acct_for_balances record id in the session.
         * 2) Retrieve the banking_acct_for_balances object with that id from the database.
         * 3) Make sure that object belongs to the user.
         * 4) Redirect to next piece of code.
         */

        global $g;


        kick_out_loggedoutusers();


        get_db();


        $g->id = $id;


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingaccountforbalances.php';


        /**
         * 4) Redirect to next piece of code.
         */

        redirect_to("/ax1/check_my_banking_account_tx_balances_show_balances/page");
    }
}