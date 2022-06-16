<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\banking_acct_for_balances;
use GoodToKnow\Models\user;

class destroy_a_bank_acct_observer_processor
{
    function page(int $id = 0)
    {
        /**
         * 1) Determine the id of the bank_account_observer record from $id and
         *    stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the bank_account_observer object with that id from the database.
         *    And, format its attributes for meaningful viewing.
         * 3) Make sure this object belongs to the user.
         * 4) Presents a form containing data from the record and asking for permission to delete.
         */

        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $g->id = $id;


        /**
         * Determine the id of the bank_account_observer record from $id and
         * stores it in $_SESSION['saved_int01'].
         * Retrieve the bank_account_observer object with that id from the database.
         * Make sure this object belongs to the user.
         *
         * $g->object and $_SESSION['saved_int01']
         * are what we get
         */

        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bank_account_observer.php';


        /**
         * Format its attributes for meaningful viewing.
         */

        $observer_user_object = user::find_by_id($g->object->observer_id);
        if (!$observer_user_object) breakout(" Error 1513. ");
        $g->object->observer_id = $observer_user_object->username;

        $account_object = banking_acct_for_balances::find_by_id($g->object->account_id);
        if (!$account_object) breakout(" Error  712131. ");
        $g->object->account_id = $account_object->acct_name;


        /**
         * Present a form containing data from the record and asking for permission to delete.
         */

        $g->html_title = "Do you want to delete?";

        require VIEWS . DIRSEP . 'destroyabankacctobserverprocessor.php';
    }
}