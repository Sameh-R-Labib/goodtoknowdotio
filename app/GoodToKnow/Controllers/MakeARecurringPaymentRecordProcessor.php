<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\RecurringPayment;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class MakeARecurringPaymentRecordProcessor
{
    function page()
    {
        /**
         * Create a database record in the recurring_payment table using the submitted
         * recurring_payment label. The remaining field values will be set to default values.
         *
         * $_POST['label']
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            breakout(' Task aborted. ');
        }

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $label = standard_form_field_prep('label', 4, 264);

        if (is_null($label)) {
            breakout(' The label you entered did not pass validation. ');
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }


        /**
         * Create a RecurringPayment array for the record.
         */

        $array_recurring_payment_record = ['user_id' => $user_id, 'label' => $label, 'currency' => '',
            'amount_paid' => 0, 'unix_time_at_last_payment' => 0, 'comment' => ''];


        /**
         * Make the array into an in memory RecurringPayment object for the record.
         */

        $recurring_payment_object = RecurringPayment::array_to_object($array_recurring_payment_record);


        /**
         * Save the object.
         */

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