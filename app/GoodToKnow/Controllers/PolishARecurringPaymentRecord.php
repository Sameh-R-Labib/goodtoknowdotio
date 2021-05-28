<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\RecurringPayment;

class PolishARecurringPaymentRecord
{
    function page()
    {
        /**
         * This feature is for editing/updating a RecurringPayment record.
         *
         * This route is for presenting a form for getting the user to tell us which RecurringPayment
         * record he wants to edit. It will present a series of radio buttons to choose from.
         */

        global $db;
        global $sessionMessage;
        global $user_id;            // We need this.
        global $html_title;
        global $array_of_recurring_payment_objects;


        kick_out_loggedoutusers();


        /**
         * Get an array of RecurringPayment objects belonging to the current user.
         */

        $db = get_db();

        $sql = 'SELECT * FROM `recurring_payment` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';

        $array_of_recurring_payment_objects = RecurringPayment::find_by_sql($sql);

        if (!$array_of_recurring_payment_objects || !empty($sessionMessage)) {

            breakout(' I could NOT find any recurring payment records ¯\_(ツ)_/¯. ');

        }


        $html_title = 'Which recurring_payment record?';


        require VIEWS . DIRSEP . 'polisharecurringpaymentrecord.php';
    }
}