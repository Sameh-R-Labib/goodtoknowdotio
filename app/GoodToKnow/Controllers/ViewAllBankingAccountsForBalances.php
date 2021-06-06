<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class ViewAllBankingAccountsForBalances
{
    function page()
    {
        /**
         * Similar to RecurringPaymentSeeMyRecords.
         */


        global $gtk;
        global $array_of_objects;


        require CONTROLLERINCLUDES . DIRSEP . 'get_bankingaccountsforbalances.php';


        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        foreach ($array_of_objects as $object) {

            $object->start_time = get_readable_time($object->start_time);
            $object->comment = nl2br($object->comment, false);
            $object->start_balance = readable_amount_of_money($object->currency, $object->start_balance);

        }


        /**
         * Present the view.
         */

        $gtk->html_title = "Bank Account";

        $gtk->show_poof = true;

        $gtk->page = 'ViewAllBankingAccountsForBalances';

        $gtk->message .= " Here are all your bank accounts. ";

        require VIEWS . DIRSEP . 'viewallbankingaccountsforbalances.php';
    }
}