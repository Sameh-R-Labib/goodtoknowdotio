<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\RecurringPayment;


class ExpungeARecurringPaymentRecord
{
    public function page()
    {
        /**
         * presenting a form for getting the user to tell us
         * which RecurringPayment record he wants to delete.
         * It will present a series of radio buttons to choose from.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $user_id;            // We need this.

        if (!$is_logged_in || !empty($sessionMessage)) {
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
         * Get an array of RecurringPayment objects belonging to the current user.
         */
        $sql = 'SELECT * FROM `recurring_payment` WHERE `user_id` = "' . $db->real_escape_string($user_id) . '"';
        $array_of_recurring_payment_objects = RecurringPayment::find_by_sql($db, $sessionMessage, $sql);
        if (!$array_of_recurring_payment_objects || !empty($sessionMessage)) {
            $sessionMessage .= ' 🤔 I could NOT find any recurring_payment records for you ¯\_(ツ)_/¯. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which recurring_payment record?';

        require VIEWS . DIRSEP . 'expungearecurringpaymentrecord.php';
    }
}