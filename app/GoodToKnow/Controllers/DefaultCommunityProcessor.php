<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;

class DefaultCommunityProcessor
{
    function page()
    {
        global $db;
        global $user_id;
        global $special_community_array;


        kick_out_loggedoutusers();


        require_once CONTROLLERHELPERS . DIRSEP . 'community_for_regular_user_prep.php';

        $chosen_id = community_for_regular_user_prep('choice');


        /**
         * Update the user's record with the new default community id
         */

        /**
         * Get the user object from the database.
         */

        $db = get_db();

        $user_object = User::find_by_id($user_id);

        if (!$user_object) {

            breakout(' Expected submission of choice not found. ');

        }

        $user_object->id_of_default_community = $chosen_id;

        $was_updated = $user_object->save();

        if (!$was_updated) {

            breakout(' Failed to update your user record. ');

        }


        // User will know default community by logging out then in.

        breakout(" Your default community has been changed to {$special_community_array[$chosen_id]}. ");
    }
}