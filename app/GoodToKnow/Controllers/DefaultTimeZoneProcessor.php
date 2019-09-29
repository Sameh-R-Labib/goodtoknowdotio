<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class DefaultTimeZoneProcessor
{
    function page()
    {
        /**
         * Modify the database record for this user table using the submitted timestamp.
         */

        global $sessionMessage;

        global $user_id;

        kick_out_loggedoutusers();

        kick_out_onabort();

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $timezone = standard_form_field_prep('timezone', 2, 60);

        if (!date_default_timezone_set($timezone)) {

            breakout(' Invalid PHP time zone submitted 👎🏽. ');

        }

        $db = get_db();

        $user_object = User::find_by_id($db, $sessionMessage, $user_id);

        if (!$user_object) {

            breakout(' Expected submission of choice not found. ');

        }

        $user_object->timezone = $timezone;

        $was_updated = $user_object->save($db, $sessionMessage);

        if (!$was_updated) {

            breakout(' Failed to update your user record. ');

        }


        // User will know default community by logging out then in.

        breakout(" Your default timezone has been changed to <b>{$timezone}</b>. ");
    }
}