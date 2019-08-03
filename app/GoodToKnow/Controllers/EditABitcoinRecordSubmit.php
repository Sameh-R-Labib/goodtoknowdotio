<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Bitcoin;


class EditABitcoinRecordSubmit
{
    function page()
    {
        /**
         * This function will:
         * 1) Validate the submitted editabitcoinrecordprocessor.php form data.
         * 2) Retrieve the existing record from the database.
         * 3) Modify the retrieved record by updating it with the submitted data.
         * 4) Update/save the updated record in the database.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;    // bitcoin record id

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
         * 1) Validate the submitted editabitcoinrecordprocessor.php form data.
         */
        if (!isset($_POST['submit'])) {
            $sessionMessage .= " Error 07730. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $edited_initial_balance = (isset($_POST['initial_balance'])) ? (float)$_POST['initial_balance'] : 0.0;
        $edited_current_balance = (isset($_POST['current_balance'])) ? (float)$_POST['current_balance'] : 0.0;
        $edited_price_point = (isset($_POST['price_point'])) ? (float)$_POST['price_point'] : 0.0;
        $edited_unix_time_at_purchase = (isset($_POST['unix_time_at_purchase'])) ? (int)$_POST['unix_time_at_purchase'] : 1560190617;
        $edited_comment = (isset($_POST['comment'])) ? $_POST['comment'] : "";
        // make sure the comment is okay.
        $result = self::is_comment($sessionMessage, $edited_comment);
        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because the comment text submitted did not comply. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

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
        $bitcoin_object = Bitcoin::find_by_id($db, $sessionMessage, $saved_int01);
        if (!$bitcoin_object) {
            $sessionMessage .= " Unexpectedly I could not find that bitcoin record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 3) Modify the retrieved record by updating it with the submitted data.
         */
        $bitcoin_object->initial_balance = $edited_initial_balance;
        $bitcoin_object->current_balance = $edited_current_balance;
        $bitcoin_object->price_point = $edited_price_point;
        $bitcoin_object->unix_time_at_purchase = $edited_unix_time_at_purchase;
        $bitcoin_object->comment = $edited_comment;

        /**
         * 4) Update/save the updated record in the database.
         */
        $result = $bitcoin_object->save($db, $sessionMessage);
        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because I failed at saving the updated Bitcoin object. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Report success.
         */
        $sessionMessage .= " I've updated address {$bitcoin_object->address}'s record. ";
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