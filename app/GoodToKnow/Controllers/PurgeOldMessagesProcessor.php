<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Message;
use function GoodToKnow\ControllerHelpers\is_date;
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

        kick_out_nonadmins();

        kick_out_onabort();

        $db = get_db();


        /**
         * $_POST['date']
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $submitted_date = standard_form_field_prep('date', 10, 14);

        if (is_null($submitted_date)) {
            breakout(' The date you entered did not pass validation. ');
        }


        /**
         * Validate the date
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'is_date.php';

        if (!is_date($sessionMessage, $submitted_date)) {
            breakout('');
        }


        /**
         * We need to convert $date to a unix timestamp
         */

        $timestamp = self::get_timestamp_from_date($submitted_date);

        if (!$timestamp || $timestamp < 0) {
            breakout(' Method get timestamp from date returned an invalid value. ');
        }


        /**
         * Delete all messages.
         *
         * The assumption is that all messages sent before the zero hour (12am) will be deleted.
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
            breakout(' Something inside of purge_all_messages_older_than_date failed. ');
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

        breakout(' The purge of old messages completed. ');
    }


    /**
     * @param string $submitted_date
     * @return false|int
     */
    public static function get_timestamp_from_date(string $submitted_date)
    {
        /**
         * It is assumed that $submitted_date is in the American form of mm/dd/yyyy.
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
}