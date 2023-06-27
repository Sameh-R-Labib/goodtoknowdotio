<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\status;

class set_system_wide_alert
{
    function page()
    {
        /**
         * FEATURE OVERVIEW
         * ================
         *
         * Feature Name: "Set System-wide Alert"
         *
         * This feature enables Admin to set the alert values (stored in the database)
         * for a running Gtk.io system.
         *
         * When a system alert is set users will see an alert message
         * added to their page message. The alert will have a bold red
         * colored font. It is the home page which checks to see if there
         * is an alert and adds it to the message.
         */

        global $g;


        kick_out_nonadmins();


        get_db();


        /**
         * Firstly, we need to get the current status object.
         */

        $status_object = status::find_by_id(2);

        if (!$status_object) {

            breakout(' ERROR 010388626: The status object could not be found. ');

        }


        /**
         * There are very specific / valid values for status name.
         * So, let's stop here if these are invalid.
         */

        if ($status_object->name !== 'system_alert' and $status_object->name !== 'no_alert') {

            breakout(' ERROR 3904844: The status name is invalid. ');

        }


        /**
         * So, we have a valid $status_object.
         * And, the $status_object reflects the status stored in the database.
         *
         *
         * WHAT TO DO NOW?
         * ===============
         *
         * We should:
         *  - display a form for Admin to see and act upon
         *  - the form tells Admin what the current mode is
         *  - the form provides input fields for setting the alert values
         *
         * The form field for entering the name of the alert will be a radio input field.
         * The form field for entering the message will be a text input field.
         */

        // we need this for the view

        $g->current_alert_name = $status_object->name;


        $g->html_title = 'Set system-wide alert';


        require VIEWS . DIRSEP . 'setsystemwidealert.php';
    }
}