<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class annul_a_banking_acct_for_balances_processor
{
    function page()
    {
        global $g;

        /**
         * 1) Determines the id of the banking_acct_for_balances record from 'choice' and
         *    stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the BankingAcctForBalances object with that id from the database.
         *    And, format its attributes for easy viewing.
         * 3) Make sure this object belongs to the user.
         * 4) Presents a form containing data from the record and asking for permission to delete.
         */


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingaccountforbalances.php';


        // Format its attributes for easy viewing.

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


        $g->object->start_time = get_readable_time($g->object->start_time);
        $g->object->start_balance = readable_amount_of_money($g->object->currency, $g->object->start_balance);
        $g->object->comment = nl2br($g->object->comment, false);


        /**
         * 3) Presents a form containing data from the record and asking for permission to delete.
         */

        $g->html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'annulabankingacctforbalancesprocessor.php';
    }
}