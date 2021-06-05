<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;

class RevampABankingTransactionForBalancesChooseRecord
{
    function page()
    {
        /**
         * This function will:
         *  1) Retrieve the user's BankingTransactionForBalances within the time range.
         *  2) Present them as choices.
         *
         * The ultimate goal is to present a BankingTransactionForBalances for editing.
         */


        global $app_state;
        global $array;


        require CONTROLLERINCLUDES . DIRSEP . 'get_banking_transactions_within_a_time_range.php';


        /**
         * Replace time with a human readable time.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';


        foreach ($array as $object) {

            $object->time = get_readable_time($object->time);

        }


        $app_state->html_title = 'Which banking_transaction_for_balances record?';


        require VIEWS . DIRSEP . 'revampabankingtransactionforbalanceschooserecord.php';
    }
}