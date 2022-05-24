<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;

class expunge_a_recurring_payment_record_processor
{
    function page(int $id = 0)
    {
        /**
         * 1) Determines the id of the recurring_payment record from 'choice' and stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the recurring_payment object with that id from the database. And, format its attributes for easy viewing.
         * 3) Make sure this object belongs to the user.
         * 4) Presents a form containing data from the record and asking for confirmation to delete.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        $g->id = $id;


        require CONTROLLERINCLUDES . DIRSEP . 'get_recurring_payment_record.php';


        /**
         * 4) Presents a form containing data from the record and asking for confirmation to delete.
         */

        // Format its attributes for easy viewing.

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        $g->recurring_payment_object->time = get_readable_time($g->recurring_payment_object->time);
        $g->recurring_payment_object->comment = nl2br($g->recurring_payment_object->comment, false);
        $g->recurring_payment_object->amount_paid = readable_amount_of_money($g->recurring_payment_object->currency, $g->recurring_payment_object->amount_paid);


        $g->html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'expungearecurringpaymentrecordprocessor.php';
    }
}