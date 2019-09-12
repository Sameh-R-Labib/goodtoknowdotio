<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\RecurringPayment;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class PolishARecurringPaymentRecordProcessor
{
    function page()
    {
        /**
         * 1) Store the submitted recurring_payment record id in the session.
         * 2) Retrieve the recurring_payment object with that id from the database.
         * 3) Make sure this object belongs to the user.
         * 4) Present a form which is populated with data from the recurring_payment object.
         */

        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();


        /**
         * 1) Store the submitted recurring_payment record id in the session.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        $chosen_id = integer_form_field_prep('choice', 1, PHP_INT_MAX);

        $_SESSION['saved_int01'] = $chosen_id;


        /**
         * 2) Retrieve the recurring_payment object with that id from the database.
         */

        $db = get_db();

        $recurring_payment_object = RecurringPayment::find_by_id($db, $sessionMessage, $chosen_id);

        if (!$recurring_payment_object) {
            breakout(' Unexpectedly I could not find that recurring payment record. ');
        }


        /**
         *  3) Make sure this object belongs to the user.
         */

        if ($recurring_payment_object->user_id != $user_id) {

            breakout(' Error 8783814. ');

        }


        /**
         * 4) Present a form which is populated with data from the recurring_payment object.
         */

        $html_title = 'Edit the recurring_payment record';

        require VIEWS . DIRSEP . 'polisharecurringpaymentrecordprocessor.php';
    }
}