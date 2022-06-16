<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\banking_acct_for_balances;
use GoodToKnow\Models\user;

class destroy_a_bank_acct_observer
{
    function page()
    {
        global $g;

        /**
         * Presenting a form for getting the user to tell us
         * which bank_account_observer record he / she wants to delete.
         * It will present a series of buttons to choose from.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


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
            if (!$user[$key]) breakout(" Error 31627. ");
            $object->observer_id = $user[$key]->username;

            // Replace the account_id with the acct_name of the banking_acct_for_balances.
            $account[$key] = banking_acct_for_balances::find_by_id($object->account_id);
            if (!$account[$key]) breakout(" Error 21580. ");
            $object->account_id = $account[$key]->acct_name;
        }


        /**
         * Present the view.
         */

        $g->html_title = "Bank Account Observers";

        require VIEWS . DIRSEP . 'destroyabankacctobserver.php';
    }
}