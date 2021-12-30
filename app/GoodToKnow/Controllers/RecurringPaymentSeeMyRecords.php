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
         * Similar to CommoditySeeMyRecords.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Get an array of RecurringPayment objects for the user who has id == $user_id.
         */

        get_db();

        $sql = 'SELECT * FROM `recurring_payment` WHERE `user_id` = "' . $g->db->real_escape_string($g->user_id) . '"';

        $g->array_of_recurring_payment_objects = RecurringPayment::find_by_sql($sql);

        if (!$g->array_of_recurring_payment_objects || !empty($g->message)) {

            breakout(' I could NOT find any recurring payments ¯\_(ツ)_/¯ ');

        }


        /**
         * Loop through the array and replace some attributes with more readable versions of themselves.
         * And apply htmlspecialchars if necessary.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        foreach ($g->array_of_recurring_payment_objects as $object) {

            $object->amount_paid = readable_amount_of_money($object->currency, $object->amount_paid);

            $object->time = get_readable_time($object->time);

            $object->comment = nl2br($object->comment, false);

        }


        $g->page = 'RecurringPaymentSeeMyRecords';


        $g->show_poof = true;


        $g->html_title = "Your recurring transactions";


        $g->message .= " Here are your recurring transactions. ";


        require VIEWS . DIRSEP . 'recurringpaymentseemyrecords.php';
    }
}