<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\RecurringPayment;
use function GoodToKnow\ControllerHelpers\float_form_field_prep;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class MakeARecurringPaymentRecordProcessor
{
    function page()
    {
        /**
         * Create a database record in the recurring_payment table using the submitted
         * recurring_payment data.
         */

        global $sessionMessage;
        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        require_once CONTROLLERHELPERS . DIRSEP . 'float_form_field_prep.php';

        $label = standard_form_field_prep('label', 4, 264);

        $currency = standard_form_field_prep('currency', 1, 15);

        $amount_paid = float_form_field_prep('amount_paid', 0.0, 21000000000.0);

        $time = integer_form_field_prep('time', 0, PHP_INT_MAX);

        if ($time === 0) $time = 1546300800;

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

        $result = $recurring_payment_object->save($db, $sessionMessage);

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