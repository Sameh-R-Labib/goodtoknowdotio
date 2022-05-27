<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\community_for_regular_user_parameter;
use GoodToKnow\Models\user;

class default_community_processor
{
    function page(int $id = 0)
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->id = $id;


        require_once CONTROLLERHELPERS . DIRSEP . 'community_for_regular_user_parameter.php';

        community_for_regular_user_parameter();


        /**
         * Update the user's record with the new default community id
         */

        /**
         * Get the user object from the database.
         */

        get_db();

        $user_object = user::find_by_id($g->user_id);

        if (!$user_object) {

            breakout(' Expected submission of choice not found. ');

        }

        $user_object->id_of_default_community = $g->id;

        $was_updated = $user_object->save();

        if (!$was_updated) {

            breakout(' Failed to update your user record. ');

        }


        // User can know his default community by logging out then in.

        breakout(" Your default community has been changed to {$g->special_community_array[$g->id]}. ");
    }
}