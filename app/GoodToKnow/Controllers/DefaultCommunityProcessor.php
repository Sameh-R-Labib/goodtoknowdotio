<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;

class DefaultCommunityProcessor
{
    function page()
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        require_once CONTROLLERHELPERS . DIRSEP . 'community_for_regular_user_prep.php';

        $chosen_id = community_for_regular_user_prep('choice');


        /**
         * Update the user's record with the new default community id
         */

        /**
         * Get the user object from the database.
         */

        get_db();

        $user_object = User::find_by_id($g->user_id);

        if (!$user_object) {

            breakout(' Expected submission of choice not found. ');

        }

        $user_object->id_of_default_community = $chosen_id;

        $was_updated = $user_object->save();

        if (!$was_updated) {

            breakout(' Failed to update your user record. ');

        }


        // User will know default community by logging out then in.

        breakout(" Your default community has been changed to {$g->special_community_array[$chosen_id]}. ");
    }
}