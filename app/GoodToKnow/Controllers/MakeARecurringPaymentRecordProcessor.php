<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\RecurringPayment;

class MakeARecurringPaymentRecordProcessor
{
    public function page()
    {
        /**
         * Create a database record in the
         * recurring_payment table using the
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
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $label = (isset($_POST['label'])) ? $_POST['label'] : '';
        if (empty($label)) {
            $sessionMessage .= " Either you did not fill out the input fields or the session expired. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (strlen($label) > 264 || strlen($label) < 4) {
            $sessionMessage .= " Either the label is too long or too short. Start over. ";
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
         * Apply htmlspecialchars to fields which
         * get rendered by the browser.
         *
         * By convention: We apply htmlspecialchars() to data at
         * the point in time before that data gets saved in
         * the database.
         */
        $label = htmlspecialchars($label);

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
        $sessionMessage .= " A new recurring_payment record was created! ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}