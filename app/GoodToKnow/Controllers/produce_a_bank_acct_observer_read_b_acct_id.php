<?php

namespace GoodToKnow\Controllers;

class produce_a_bank_acct_observer_read_b_acct_id
{
    function page(int $id = 0)
    {
        global $g;


        /**
         * 1) Store the submitted banking_acct_for_balances record id in the session.
         * 2) Retrieve the banking_acct_for_balances object with that id from the database.
         * 3) Make sure this object belongs to the user.
         * 4) Create and save a bank_account_observer
         *    which ties together the three types of id
         *    found in a bank_account_observer.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $g->id = $id;


        /**
         * This statement gets us:
         *   - $_SESSION['saved_int01'] = $g->id  // is the submitted banking_acct_for_balances record id
         *   - $g->object // is the banking_acct_for_balances object
         *   - Makes sure this banking_acct_for_balances object belongs to the user.
         */

        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingaccountforbalances.php';


        /**
         * Create and save a bank_account_observer which ties together
         * the three types of id found in a bank_account_observer.
         */

    }
}