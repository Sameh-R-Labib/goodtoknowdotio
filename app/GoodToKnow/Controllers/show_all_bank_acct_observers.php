<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\banking_acct_for_balances;
use GoodToKnow\Models\user;

class show_all_bank_acct_observers
{
    function page()
    {
        /**
         * The Goals:
         *   - To show the user all the bank_account_observer objects
         *     in which he / she is the owner.
         *   - To show the attributes of each bank_account_observer
         *     in a user-friendly way.
         */


        global $g;


        kick_out_loggedoutusers();


        get_db();


        /**
         * Get $g->array_of_objects.
         */

        require CONTROLLERINCLUDES . DIRSEP . 'get_bank_account_observer_objects_for_loggedin_user.php';


        /**
         * Loop through the array and replace some attributes with more user-friendly versions of themselves.
         */

        foreach ($g->array_of_objects as $key => $object) {

            // Replace the observer_id with the username of the observing user.
            $user[$key] = user::find_by_id($object->observer_id);
            if (!$user[$key]) breakout(" Error 36627. ");
            $object->observer_id = $user[$key]->username;

            // Replace the account_id with the acct_name of the banking_acct_for_balances.
            $account[$key] = banking_acct_for_balances::find_by_id($object->account_id);
            if (!$account[$key]) breakout(" Error 28580. ");
            $object->account_id = $account[$key]->acct_name;

        }


        /**
         * Present the view.
         */

        $g->html_title = "Bank Account Observers";

        $g->show_poof = true;

        $g->page = 'show_all_bank_acct_observers';

        $g->message .= " Here are all the bank account observers you own. ";
        reset_feature_session_vars();
        require VIEWS . DIRSEP . 'showallbankacctobservers.php';
    }
}