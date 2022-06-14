<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\bank_account_observer;
use GoodToKnow\Models\user;

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
         *   - $_SESSION['saved_int01'] is the validated and submitted banking_acct_for_balances record id
         *   - $g->object // is the banking_acct_for_balances object
         *   - Makes sure this banking_acct_for_balances object belongs to the user.
         */

        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingaccountforbalances.php';


        /**
         * We need the observer_id.
         */

        $g->user_object = user::find_by_username($g->saved_str01);

        if (!$g->user_object) {

            breakout(' Unexpected unable to retrieve target user object. ');

        }


        /**
         * Create and save a bank_account_observer which ties together
         * the three types of id found in a bank_account_observer.
         */

        $bank_account_observer_array = ['observer_id' => $g->user_object->id, 'owner_id' => $g->user_id,
            'account_id' => $_SESSION['saved_int01']];

        $bank_account_observer_object = bank_account_observer::array_to_object($bank_account_observer_array);

        $result = $bank_account_observer_object->save();

        if (!$result) {

            breakout(' Unexpected I was unable to save the bank_account_observer. ');

        }


        /**
         * Report success.
         */

        breakout(" The bank_account_observer for {$g->object->acct_name} has been created 👌. ");

    }
}