<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;

class revamp_a_banking_transaction_for_balances_choose_record
{
    function page()
    {
        /**
         * This function will:
         *  1) Retrieve the user's banking_transaction_for_balances within the time range.
         *  2) Present them as choices.
         *
         * The ultimate goal is to present a banking_transaction_for_balances for editing.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_banking_transactions_within_a_time_range.php';


        /**
         * Replace time with a human-readable time.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';


        foreach ($g->array as $object) {

            $object->time = get_readable_time($object->time);

        }


        $g->html_title = 'Which banking_transaction_for_balances record?';


        require VIEWS . DIRSEP . 'revampabankingtransactionforbalanceschooserecord.php';
    }
}