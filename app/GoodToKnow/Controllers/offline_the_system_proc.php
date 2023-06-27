<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\status;
use function GoodToKnow\ControllerHelpers\yes_no_parameter_validation;

class offline_the_system_proc
{
    function page(string $answer = 'no')
    {


        global $g;


        kick_out_nonadmins();


        get_db();


        $g->answer = $answer;


        require_once CONTROLLERHELPERS . DIRSEP . 'yes_no_parameter_validation.php';


        yes_no_parameter_validation();


        /**
         * Do nothing if user changed mind.
         */

        if ($g->answer == "no") {

            breakout(' You backed out. ');

        }


        /**
         * At this point we know:
         *  1. It's Admin who is using this route.
         *  2. Admin has decided to toggle the system status
         *     (two possible statuses: "normal" and "offline")
         */


        /**
         * Get the current status object.
         */

        $status_object = status::find_by_id(1);

        if (!$status_object) {

            breakout(' ERROR: No status object found. ');

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


        /**
         * Toggle
         */

        if ($status_object->name == 'normal') {

            $status_object->name = 'offline';
            $status_object->message = 'The system is operating with offline status.';

        } elseif ($status_object->name == 'offline') {

            $status_object->name = 'normal';
            $status_object->message = 'The system is operating with normal status.';

        } else {

            breakout(' ERROR: 20035902. ');

        }


        /**
         * Save / Update
         */

        $result = $status_object->save();

        if ($result === false) {

            breakout(' I failed at saving the status object (most likely because no changes were made to it.) ');

        }


        /**
         * Report success.
         */

        breakout(" The system status has been toggled over to <b>$status_object->name</b> 👌🏽. ");

    }
}