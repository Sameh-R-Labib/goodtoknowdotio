<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\RecurringPayment;


class PolishARecurringPaymentRecordSubmit
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted polisharecurringpaymentrecordprocessor.php form data.
         *      (and apply htmlspecialchars)
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         * 5) Report success.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;    // recurring_payment id

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Validate the submitted polisharecurringpaymentrecordprocessor.php form data.
         *      (and apply htmlspecialchars)
         */
        if (!isset($_POST['submit'])) {
            $sessionMessage .= " Error 02730. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $edited_label = (isset($_POST['label'])) ? $_POST['label'] : "";
        $edited_currency = (isset($_POST['currency'])) ? $_POST['currency'] : "";
        $edited_amount_paid = (isset($_POST['amount_paid'])) ? (float)$_POST['amount_paid'] : 0;
        $edited_unix_time_at_last_payment = (isset($_POST['unix_time_at_last_payment'])) ? (int)$_POST['unix_time_at_last_payment'] : 1560190617;
        $edited_comment = (isset($_POST['comment'])) ? $_POST['comment'] : "";
        // make sure the comment is okay.
        $result = self::is_comment($sessionMessage, $edited_comment);
        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because the comment text submitted did not comply. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $edited_label = htmlspecialchars($edited_label);
        $edited_currency = htmlspecialchars($edited_currency);

        /**
         * 2) Retrieve the existing record from the database.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $recurring_payment_object = RecurringPayment::find_by_id($db, $sessionMessage, $saved_int01);
        if (!$recurring_payment_object) {
            $sessionMessage .= " Unexpectedly I could not find that recurring_payment record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */
        $recurring_payment_object->label = $edited_label;
        $recurring_payment_object->currency = $edited_currency;
        $recurring_payment_object->amount_paid = $edited_amount_paid;
        $recurring_payment_object->unix_time_at_last_payment = $edited_unix_time_at_last_payment;
        $recurring_payment_object->comment = $edited_comment;

        /**
         * 4) Update/save the updated record in the database.
         */
        $result = $recurring_payment_object->save($db, $sessionMessage);
        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because I failed at saving the updated RecurringPayment object. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 5) Report success.
         */
        $sessionMessage .= " I've updated <b>{$recurring_payment_object->label}</b>. ";
        $_SESSION['message'] = $sessionMessage;
        $_SESSION['saved_int01'] = 0;
        redirect_to("/ax1/Home/page");
    }

    /**
     * @param $message
     * @param string $comment
     * @return bool
     */
    public static function is_comment(string &$message, string &$comment)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must be less than 800 characters long.
         * Can't contain any html tags
         */
        $comment = trim($comment);

        if (empty($comment)) {
            $message .= " Your comment is missing. ";
            return false;
        }

        $length = strlen($comment);
        if ($length > 800) {
            $message .= " Your comment is too long. ";
            return false;
        }

        if ($comment != strip_tags($comment)) {
            $message .= " Your comment includes html. We don't allow that in this field. ";
            return false;
        }

        return true;
    }
}