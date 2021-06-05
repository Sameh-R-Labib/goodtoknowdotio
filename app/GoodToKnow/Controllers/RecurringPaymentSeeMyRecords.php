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


        global $app_state;
        global $db;
        global $show_poof;
        global $html_title;
        global $array_of_recurring_payment_objects;


        kick_out_loggedoutusers();


        /**
         * Get an array of RecurringPayment objects for the user who has id == $user_id.
         */

        $db = get_db();

        $sql = 'SELECT * FROM `recurring_payment` WHERE `user_id` = "' . $db->real_escape_string($app_state->user_id) . '"';

        $array_of_recurring_payment_objects = RecurringPayment::find_by_sql($sql);

        if (!$array_of_recurring_payment_objects || !empty($app_state->message)) {

            breakout(' I could NOT find any recurring payments ¯\_(ツ)_/¯ ');

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


        $app_state->page = 'RecurringPaymentSeeMyRecords';


        $show_poof = true;


        $html_title = "Your recurring transactions";


        $app_state->message .= " Here are your recurring transactions. ";


        require VIEWS . DIRSEP . 'recurringpaymentseemyrecords.php';
    }
}