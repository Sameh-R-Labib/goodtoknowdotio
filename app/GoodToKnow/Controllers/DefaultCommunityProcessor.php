<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;

class DefaultCommunityProcessor
{
    function page()
    {
        global $user_id;
        global $sessionMessage;
        global $special_community_array;

        kick_out_loggedoutusers();

        kick_out_onabort();

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';


        // int(10) in mysql has max 4294967295

        $chosen_id = integer_form_field_prep('choice', 1, 4294967295);


        /**
         * Make sure the submitted choice is valid for this user.
         */

        $is_found = false;

        if (array_key_exists($chosen_id, $special_community_array)) $is_found = true;

        if (!$is_found) {

            breakout(' Choice is not valid. ');

        }


        /**
         * Update the user's record with the new default community id
         */

        /**
         * Get the user object from the database.
         */

        $db = get_db();

        $user_object = User::find_by_id($db, $sessionMessage, $user_id);

        if (!$user_object) {
            breakout(' Expected submission of choice not found. ');
        }

        $user_object->id_of_default_community = $_POST['choice'];

        $was_updated = $user_object->save($db, $sessionMessage);

        if (!$was_updated) {

            breakout(' Failed to update your user record. ');

        }


        // User will know default community by logging out then in.

        breakout(" Your default community has been changed to {$special_community_array[$_POST['choice']]}. ");
    }
}