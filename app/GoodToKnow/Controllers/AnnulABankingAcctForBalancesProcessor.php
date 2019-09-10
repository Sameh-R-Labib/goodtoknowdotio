<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class AnnulABankingAcctForBalancesProcessor
{
    function page()
    {
        /**
         * 1) Determines the id of the banking_acct_for_balances record from $_POST['choice'] and
         *    stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the BankingAcctForBalances object with that id from the database.
         *    And, format its attributes for easy viewing.
         * 3) Presents a form containing data from the record and asking for permission to delete.
         */

        require CONTROLLERINCLUDES . DIRSEP . 'get_the_bankingaccountforbalances.php';


        // Format its attributes for easy viewing.

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';


        /** @noinspection PhpUndefinedVariableInspection */

        $object->start_time = get_readable_time($object->start_time);
        $object->start_balance = readable_amount_of_money($object->currency, $object->start_balance);
        $object->comment = nl2br($object->comment, false);


        /**
         * 3) Presents a form containing data from the record and asking for permission to delete.
         */

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'annulabankingacctforbalancesprocessor.php';
    }
}