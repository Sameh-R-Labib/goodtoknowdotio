<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Bitcoin;


class DeleteABitcoinRecordProcessor
{
    public function page()
    {
        /**
         * 1) Determines the id of the bitcoin record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
         * 2) Retrieve the Bitcoin object with that id from the database.
         * 3) Presents a form containing data from the record and asking for confirmation to delete.
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
         * 1) Determines the id of the bitcoin record from $_POST['choice'] and stores it in $_SESSION['saved_int01'].
         */
        $chosen_id = (isset($_POST['choice'])) ? (int)$_POST['choice'] : 0;
        if ($chosen_id == 0) {
            $sessionMessage .= " You didn't choose so I've aborted the process for you. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $_SESSION['saved_int01'] = $chosen_id;

        /**
         * 2) Retrieve the Bitcoin object with that id from the database.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        $bitcoin_object = Bitcoin::find_by_id($db, $sessionMessage, $chosen_id);
        if (!$bitcoin_object) {
            $sessionMessage .= " Unexpectedly I could not find that bitcoin record. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }
        // Format the attributes for easy viewing
        $bitcoin_object->unix_time_at_purchase = self::get_readable_time($bitcoin_object->unix_time_at_purchase);
        $bitcoin_object->comment = nl2br($bitcoin_object->comment, false);
        $bitcoin_object->price_point = number_format($bitcoin_object->price_point, 2);
        $bitcoin_object->initial_balance = number_format($bitcoin_object->initial_balance, 8);
        $bitcoin_object->current_balance = number_format($bitcoin_object->current_balance, 8);

        /**
         * 3) Presents a form containing data from the record and asking for confirmation to delete.
         */
        $html_title = 'Are you sure?';

        require VIEWS . DIRSEP . 'deleteabitcoinrecordprocessor.php';
    }

    /**
     * @param \mysqli $db
     * @param string $error
     * @param $created
     * @return string
     */
    public static function get_readable_time($created)
    {
        $created = (int)$created;
        $date = date('m/d/Y h:ia ', $created) . "<small>[" . date_default_timezone_get() . "]</small>";
        return $date;
    }
}