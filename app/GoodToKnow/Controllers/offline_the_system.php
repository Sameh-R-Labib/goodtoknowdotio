<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\status;

class offline_the_system
{
    function page()
    {
        /**
         * FEATURE OVERVIEW
         * ================
         *
         * Feature Name: "Offline The System"
         *
         * This feature enables Admin to toggle a running Gtk.io system
         * between "normal" and "offline" state.
         *
         * The offline state kicks out all non-Admin users to the login page.
         * This gives Admin the opportunity to do maintenance on the system
         * without bothering with user activity which may cause anomalies.
         */

        global $g;


        kick_out_nonadmins_or_if_there_is_error_msg();


        get_db();


        /**
         * Firstly, we need to get the current status object.
         */

        $status_object = status::find_by_id(1);

        if (!$status_object) {

            breakout(' ERROR: The status object could not be found. ');

        }


        /**
         * There are very specific / valid values for status name and status message.
         * So, let's stop here if these are invalid.
         */

        if ($status_object->name !== 'normal' and $status_object->name !== 'offline') {

            breakout(' ERROR: The status name is invalid. ');

        }

        if ($status_object->message !== 'The system is operating with normal status.' and
            $status_object->message !== 'The system is operating with offline status.') {

            breakout(' ERROR: The status message is invalid. ');

        }


    }
}