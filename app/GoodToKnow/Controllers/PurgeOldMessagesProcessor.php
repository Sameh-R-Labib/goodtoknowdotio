<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2018-12-27
 * Time: 22:19
 */

namespace GoodToKnow\Controllers;


class PurgeOldMessagesProcessor
{
    public function page()
    {
        /**
         * This code will:
         *   1) Receive submitted date.
         *   2) Delete the messages.
         *   3) Report success or failure.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;

        if (!$is_logged_in OR !$is_admin OR !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Variables to work with:
         *   $_POST['date'], $_POST['submit']
         */

        /**
         * I can't assume these post variables exist so I do the following.
         */

        $submitted_date = (isset($_POST['date'])) ? $_POST['date'] : '';
//        $submitted_submit = (isset($_POST['submit'])) ? $_POST['submit'] : '';

        /**
         * Validate the date
         */
        if (!self::is_date($sessionMessage, $submitted_date)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }


    }

    /**
     * @param $message
     * @param string $date
     * @return bool
     */
    public static function is_date(string &$message, string &$date)
    {
        /**
         * Trim it.
         * Can't be empty.
         * Must have two forward slashes.
         * Must have 2 digits / 2 digits / 4 digits
         * Must be a valid date.
         */

        $date = trim($date);

        if (empty($date)) {
            $message .= " The date is missing. ";
            return false;
        }

        $number_of_slashes = substr_count($date, '/');
        if ($number_of_slashes != 2) {
            $message .= " You don't have two slashes in date. ";
            return false;
        }

        /**
         * Split date into its parts.
         */
        $words = explode('/', $date);
        $mm = $words[0];
        $dd = $words[1];
        $yyyy = $words[2];

        if (strlen($mm) != 2 || strlen($dd) != 2 || strlen($yyyy) != 4) {
            $message .= " You did not use correct mm/dd/yyyy date format. ";
            return false;
        }

        if (!is_numeric($mm) || !is_numeric($dd) || !is_numeric($yyyy)) {
            $message .= " The date should consist of numeric digits and 2 forward slashes. And, it does not have
            numeric digits! ";
            return false;
        }

        if (!checkdate($words[0], $words[1], $words[2])) {
            $message .= " That's not a valid date. ";
            return false;
        }

        return true;
    }
}