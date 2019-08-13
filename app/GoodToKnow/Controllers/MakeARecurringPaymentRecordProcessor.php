<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\RecurringPayment;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class MakeARecurringPaymentRecordProcessor
{
    function page()
    {
        /**
         * Create a database record in the
         * recurring_payment table using the submitted
         * recurring_payment label. The remaining
         * field values will be set to default values.
         *
         * $_POST['label']
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $label = standard_form_field_prep('label', 4, 264);

        if (is_null($label)) {
            $sessionMessage .= " The label you entered did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
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
            $sessionMessage .= ' The save method for RecurringPayment returned false. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (!empty($sessionMessage)) {
            $sessionMessage .= ' The save method for RecurringPayment did not return false but it did send back a message.
             Therefore, it probably did not create the RecurringPayment record. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Wrap it up.
         */
        $sessionMessage .= " A recurring_payment record was created! ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}