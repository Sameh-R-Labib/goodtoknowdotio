<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\RecurringPayment;

class PolishARecurringPaymentRecordProcessor
{
    function page()
    {
        /**
         * 1) Store the submitted recurring_payment record id in the session.
         * 2) Retrieve the recurring_payment object with that id from the database.
         * 3) Present a form which is populated with data from the recurring_payment object.
         */

        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Store the submitted recurring_payment record id in the session.
         */
        $chosen_id = (isset($_POST['choice'])) ? (int)$_POST['choice'] : 0;
        if ($chosen_id == 0) {
            $sessionMessage .= " You didn't choose so I've aborted the process for you. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $_SESSION['saved_int01'] = $chosen_id;

        /**
         * 2) Retrieve the recurring_payment object with that id from the database.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $recurring_payment_object = RecurringPayment::find_by_id($db, $sessionMessage, $chosen_id);
        if (!$recurring_payment_object) {
            $sessionMessage .= " Unexpectedly I could not find that recurring_payment record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Present a form which is populated with data from the recurring_payment object.
         */
        $html_title = 'Edit the recurring_payment record';

        require VIEWS . DIRSEP . 'polisharecurringpaymentrecordprocessor.php';
    }
}