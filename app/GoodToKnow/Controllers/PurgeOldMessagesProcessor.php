<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\Message;
use function GoodToKnow\ControllerHelpers\date_form_field_prep;
use function GoodToKnow\ControllerHelpers\get_timestamp_from_date;

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


        kick_out_nonadmins();


        /**
         * 'date'
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'date_form_field_prep.php';

        $submitted_date = date_form_field_prep('date');


        /**
         * We need to convert $date to a unix timestamp
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'get_timestamp_from_date.php';

        $timestamp = get_timestamp_from_date($submitted_date);


        /**
         * Delete all messages.
         *
         * The assumption is that all messages sent before the zero hour (12am) will be deleted.
         */

        get_db();

        $result = Message::purge_all_messages_older_than_date($timestamp);


        /**
         * If $result === false that means the code has a bug.
         *
         * Add something reflecting general failure of this route to $g->message.
         *
         * Add $g->message to the session.
         *
         * Redirect to Home page.
         */

        if ($result === false) {

            breakout(' Something inside of purge_all_messages_older_than_date failed. ');

        }


        /**
         * Report that we have completed the purge.
         *
         * Say something reflecting success $g->message.
         *
         * Add $g->message to the session.
         *
         * Redirect to Home page
         */

        breakout(' The purge of old messages completed. ');
    }
}