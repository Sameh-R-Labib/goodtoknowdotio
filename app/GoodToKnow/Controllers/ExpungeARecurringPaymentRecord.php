<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\RecurringPayment;

class ExpungeARecurringPaymentRecord
{
    function page()
    {
        /**
         * Presenting a form for getting the user to tell us which RecurringPayment record he wants to delete.
         * It will present a series of radio buttons to choose from.
         */


        global $db;
        global $app_state;
        global $html_title;
        global $array_of_recurring_payment_objects;


        kick_out_loggedoutusers();


        $db = get_db();


        /**
         * Get an array of RecurringPayment objects belonging to the current user.
         */

        $sql = 'SELECT * FROM `recurring_payment` WHERE `user_id` = "' . $db->real_escape_string($app_state->user_id) . '"';

        $array_of_recurring_payment_objects = RecurringPayment::find_by_sql($sql);

        if (!$array_of_recurring_payment_objects || !empty($app_state->message)) {
            breakout(' I could NOT find any recurring payments ¯\_(ツ)_/¯. ');
        }

        $html_title = 'Which recurring_payment record?';

        require VIEWS . DIRSEP . 'expungearecurringpaymentrecord.php';
    }
}