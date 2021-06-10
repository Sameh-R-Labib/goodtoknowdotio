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


        global $g;


        kick_out_loggedoutusers();


        $g->db = get_db();


        /**
         * Get an array of RecurringPayment objects belonging to the current user.
         */

        $sql = 'SELECT * FROM `recurring_payment` WHERE `user_id` = "' . $g->db->real_escape_string($g->user_id) . '"';

        $g->array_of_recurring_payment_objects = RecurringPayment::find_by_sql($sql);

        if (!$g->array_of_recurring_payment_objects || !empty($g->message)) {

            breakout(' I could NOT find any recurring payments ¯\_(ツ)_/¯. ');

        }

        $g->html_title = 'Which recurring_payment record?';

        require VIEWS . DIRSEP . 'expungearecurringpaymentrecord.php';
    }
}