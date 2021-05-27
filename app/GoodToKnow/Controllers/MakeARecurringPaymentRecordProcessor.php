<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\RecurringPayment;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class MakeARecurringPaymentRecordProcessor
{
    function page()
    {
        /**
         * Create a database record in the recurring_payment table using the submitted
         * recurring_payment data.
         */


        global $db;
        global $sessionMessage;
        global $user_id;
        global $time;


        kick_out_loggedoutusers();


        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';
        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        $label = standard_form_field_prep('label', 4, 264);

        $currency = standard_form_field_prep('currency', 1, 15);

        $amount_paid = float_form_field_prep('amount_paid', 0.0, 999999999999999.99);


        // - - - Get $time (which is a timestamp) based on submitted `timezone` `date` `hour` `minute` `second`
        require CONTROLLERINCLUDES . DIRSEP . 'figure_out_time_epoch.php';
        // - - -


        $comment = standard_form_field_prep('comment', 0, 800);


        /**
         * Create a RecurringPayment array for the record.
         */


        $array_recurring_payment_record = ['user_id' => $user_id, 'label' => $label, 'currency' => $currency,
            'amount_paid' => $amount_paid, 'time' => $time, 'comment' => $comment];


        /**
         * Make the array into an in memory RecurringPayment object for the record.
         */

        $recurring_payment_object = RecurringPayment::array_to_object($array_recurring_payment_record);


        /**
         * Save the object.
         */

        $db = get_db();

        $result = $recurring_payment_object->save($db);

        if (!$result) {

            breakout(' The save method for RecurringPayment returned false. ');

        }

        if (!empty($sessionMessage)) {

            breakout(' The save method for RecurringPayment did not return false but it did send back a message.
             Therefore, it probably did not create the RecurringPayment record. ');

        }


        /**
         * Wrap it up.
         */

        breakout(' A recurring payment record was created 👍. ');
    }
}