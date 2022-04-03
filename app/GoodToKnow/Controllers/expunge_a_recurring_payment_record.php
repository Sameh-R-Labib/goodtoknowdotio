<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\recurring_payment;

class expunge_a_recurring_payment_record
{
    function page()
    {
        /**
         * Presenting a form for getting the user to tell us which recurring_payment record he wants to delete.
         * It will present a series of radio buttons to choose from.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        /**
         * Get an array of recurring_payment objects belonging to the current user.
         */

        $sql = 'SELECT * FROM `recurring_payment` WHERE `user_id` = "' . $g->db->real_escape_string($g->user_id) . '"';

        $g->array_of_recurring_payment_objects = recurring_payment::find_by_sql($sql);

        if (!$g->array_of_recurring_payment_objects) {

            breakout(' I could NOT find any recurring payments ¯\_(ツ)_/¯. ');

        }

        $g->html_title = 'Which recurring_payment record?';

        require VIEWS . DIRSEP . 'expungearecurringpaymentrecord.php';
    }
}