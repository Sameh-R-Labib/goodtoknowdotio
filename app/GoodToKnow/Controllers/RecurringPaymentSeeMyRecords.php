<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;
use GoodToKnow\Models\RecurringPayment;

class RecurringPaymentSeeMyRecords
{
    function page()
    {
        /**
         * Similar to BitcoinSeeMyRecords.
         */

        global $user_id;
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;
        global $is_admin;
        global $is_guest;

        kick_out_loggedoutusers();

        $db = get_db();

        $html_title = 'Show Me my Recurring Payments';

        $page = 'RecurringPaymentSeeMyRecords';

        $show_poof = true;


        /**
         * Get an array of RecurringPayment objects for the user who has id == $user_id.
         */

        $sql = 'SELECT * FROM `recurring_payment` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';

        $array_of_recurring_payment_objects = RecurringPayment::find_by_sql($db, $sessionMessage, $sql);

        if (!$array_of_recurring_payment_objects || !empty($sessionMessage)) {
            breakout(' I could NOT find any recurring payments ¯\_(ツ)_/¯. ');
        }


        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * And apply htmlspecialchars if necessary.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        foreach ($array_of_recurring_payment_objects as $object) {

            $object->amount_paid = readable_amount_of_money($object->currency, $object->amount_paid);

            $object->time = get_readable_time($object->time);

            $object->comment = nl2br($object->comment, false);

        }

        $html_title = 'Enjoy ʘ‿ʘ at your 🌀 💳 📽s.';

        $sessionMessage .= ' Enjoy ʘ‿ʘ at your 🌀 💳 📽s. ';

        require VIEWS . DIRSEP . 'recurringpaymentseemyrecords.php';
    }
}