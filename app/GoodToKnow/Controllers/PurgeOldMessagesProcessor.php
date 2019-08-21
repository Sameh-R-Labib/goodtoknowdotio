<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2018-12-27
 * Time: 22:19
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Message;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class PurgeOldMessagesProcessor
{
    function page()
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
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * Variables to work with:
         *   $_POST['date']
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $submitted_date = standard_form_field_prep('date', 10, 14);

        if (is_null($submitted_date)) {
            $sessionMessage .= ' The date you entered did not pass validation. ';
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * Validate the date
         */
        if (!self::is_date($sessionMessage, $submitted_date)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * We need to convert $date to a unix timestamp
         */
        $timestamp = self::get_timestamp_from_date($submitted_date);

        if (!$timestamp || $timestamp < 0) {
            $sessionMessage .= " Method get_timestamp_from_date returned an invalid value. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * Delete all messages.
         *
         * The assumption is that all messages
         * sent before the zero hour (12am)
         * will be deleted.
         */
        $result = Message::purge_all_messages_older_than_date($db, $sessionMessage, $timestamp);

        /**
         * If $result === false that means the code has a bug.
         *
         * Add something reflecting general failure of this route to $sessionMessage.
         *
         * Add $sessionMessage to the session.
         *
         * Redirect to Home page.
         */
        if ($result === false) {
            $sessionMessage .= " Something inside of purge_all_messages_older_than_date failed. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        /**
         * Report that we have completed the purge.
         *
         * Say something reflecting success $sessionMessage.
         *
         * Add $sessionMessage to the session.
         *
         * Redirect to Home page
         */
        $sessionMessage .= " The purge of old messages completed. ";
        $_SESSION['message'] = $sessionMessage;
        reset_feature_session_vars();
        redirect_to("/ax1/Home/page");
    }

    /**
     * @param string $submitted_date
     * @return false|int
     */
    public static function get_timestamp_from_date(string $submitted_date)
    {
        /**
         * It is assumed that $submitted_date is
         * in the American form of mm/dd/yyyy.
         * For example 01/02/2019
         */

        // Separate the parts of #submitted_date
        $words = explode('/', $submitted_date);
        $day = $words[1];
        $month = $words[0];
        $year = $words[2];

        $timestamp = mktime(0, 0, 0, $month, $day, $year);

        return $timestamp;
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