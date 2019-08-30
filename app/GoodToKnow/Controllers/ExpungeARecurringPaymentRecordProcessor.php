<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\get_readable_time;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\readable_amount_of_money;
use GoodToKnow\Models\RecurringPayment;

class ExpungeARecurringPaymentRecordProcessor
{
    function page()
    {
        /**
         * 1) Determines the id of the recurring_payment record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the RecurringPayment object with that id from the database. And, format its attributes for easy viewing.
         * 3) Presents a form containing data from the record and asking for confirmation to delete.
         */

        global $is_logged_in;
        global $sessionMessage;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Determines the id of the recurring_payment record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        $_SESSION['saved_int01'] = $chosen_id;


        /**
         * 2) Retrieve the RecurringPayment object with that id from the database. And, format its attributes for easy viewing.
         */

        $db = get_db();

        $recurring_payment_object = RecurringPayment::find_by_id($db, $sessionMessage, $chosen_id);

        if (!$recurring_payment_object) {

            breakout(' Unexpectedly I could not find that recurring payment. ');

        }


        // Format its attributes for easy viewing.

        require_once CONTROLLERHELPERS . DIRSEP . 'get_readable_time.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'readable_amount_of_money.php';

        $recurring_payment_object->time = get_readable_time($recurring_payment_object->time);
        $recurring_payment_object->comment = nl2br($recurring_payment_object->comment, false);
        $recurring_payment_object->amount_paid = readable_amount_of_money($recurring_payment_object->currency, $recurring_payment_object->amount_paid);


        /**
         * 3) Presents a form containing data from the record and asking for confirmation to delete.
         */

        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'expungearecurringpaymentrecordprocessor.php';
    }
}