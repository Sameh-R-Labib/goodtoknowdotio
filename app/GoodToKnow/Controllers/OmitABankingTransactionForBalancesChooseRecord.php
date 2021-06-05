<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;

class OmitABankingTransactionForBalancesChooseRecord
{
    function page()
    {
        /**
         * This function will:
         *  1) Retrieve the user's BankingTransactionForBalances within the time range.
         *  2) Present them as choices.
         *
         * The ultimate goal is to present a BankingTransactionForBalances for deletion.
         */


        global $array;
        global $gtk;


        require CONTROLLERINCLUDES . DIRSEP . 'get_banking_transactions_within_a_time_range.php';


        /**
         * Replace time with a human readable time.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        foreach ($array as $object) {

            $object->time = get_readable_time($object->time);

        }


        $gtk->html_title = 'Which banking transaction for balances record?';


        require VIEWS . DIRSEP . 'omitabankingtransactionforbalanceschooserecord.php';
    }
}