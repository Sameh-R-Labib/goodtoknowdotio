<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;
use GoodToKnow\Models\BankingAcctForBalances;

class ViewAllBankingAccountsForBalances
{
    function page()
    {
        /**
         * Similar to RecurringPaymentSeeMyRecords.
         */

        global $user_id;
        global $sessionMessage;
        global $is_logged_in;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }


        /**
         * Get an array of BankingAcctForBalances objects for the user who has id == $user_id.
         */

        $sql = 'SELECT * FROM `banking_acct_for_balances` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';

        $array_of_objects = BankingAcctForBalances::find_by_sql($db, $sessionMessage, $sql);

        if (!$array_of_objects || !empty($sessionMessage)) {
            breakout(' I could NOT find any banking accounts for balances ¯\_(ツ)_/¯. ');
        }


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

        $html_title = 'Enjoy ʘ‿ʘ at all your 🏦ing 📒s for ⚖️s.';

        $sessionMessage .= ' Enjoy ʘ‿ʘ at all your 🏦ing 📒s for ⚖️s. ';

        require VIEWS . DIRSEP . 'viewallbankingaccountsforbalances.php';
    }
}