<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\RecurringPayment;

class polish_a_recurring_payment_record
{
    function page()
    {
        /**
         * This feature is for editing/updating a RecurringPayment record.
         *
         * This route is for presenting a form for getting the user to tell us which RecurringPayment
         * record he wants to edit. It will present a series of radio buttons to choose from.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        /**
         * Get an array of RecurringPayment objects belonging to the current user.
         */

        get_db();

        $sql = 'SELECT * FROM `recurring_payment` WHERE `user_id` = "' . $g->db->real_escape_string($g->user_id) . '"';

        $g->array_of_recurring_payment_objects = RecurringPayment::find_by_sql($sql);

        if (!$g->array_of_recurring_payment_objects || !empty($g->message)) {

            breakout(' I could NOT find any recurring payment records ¯\_(ツ)_/¯. ');

        }


        $g->html_title = 'Which recurring_payment record?';


        require VIEWS . DIRSEP . 'polisharecurringpaymentrecord.php';
    }
}