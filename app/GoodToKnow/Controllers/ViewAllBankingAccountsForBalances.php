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

        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;

        $array_of_objects = [];   // Just to make PhpStorm happy.

        global $sessionMessage;   // Just to make PhpStorm happy.

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

        $page = 'ViewAllBankingAccountsForBalances';

        $show_poof = true;

        $html_title = 'Bank Accounts And Their Starting Balances';

        $sessionMessage .= ' Enjoy ʘ‿ʘ at all your bank accounts and their starting balances. ';

        require VIEWS . DIRSEP . 'viewallbankingaccountsforbalances.php';
    }
}