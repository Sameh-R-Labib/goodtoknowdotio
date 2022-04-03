<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\user_to_community;

class give_coms_choices_processor
{
    function page()
    {
        global $g;
        // $g->saved_str01 Has user's username
        // $g->saved_int01 has user's id


        kick_out_nonadmins_or_if_there_is_error_msg();


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_submitted_community_ids.php';


        /**
         * For each  comm id that was submitted
         * assign its community to the user.
         */

        /**
         * "The user" -- means The User we are attempting to assign new groups to.
         *
         * We know:
         *   saved_str01 -- contains the username
         *   saved_int01 -- contains the id of the user
         */

        /**
         * This loop will generate an array of user_to_community objects
         * to be used by the user_to_community::insert_multiple_objects method
         * so that we can insert all the user_to_community objects at once
         * instead of individually.
         */

        $array_of_usertocommunity_objects = [];

        foreach ($g->submitted_community_ids_array as $a_community_id) {

            $a_community_id = (int)$a_community_id;

            $usertocommunity_object_as_array = ['user_id' => $g->saved_int01, 'community_id' => $a_community_id];

            $array_of_usertocommunity_objects[] = user_to_community::array_to_object($usertocommunity_object_as_array);

        }


        /**
         * $array_of_usertocommunity_objects
         * Tested Good
         */

        /**
         * The goal now is to insert all these objects into the database.
         */

        get_db();

        $result = user_to_community::insert_multiple_objects($array_of_usertocommunity_objects);

        if (!$result) {

            breakout(' In give_coms_choices_processor encountered error due to
            user_to_community::array_to_object being unable to save the user_to_community records. ');

        }


        /**
         * Declare success.
         */

        breakout(" New communities were assigned to {$g->saved_str01}! ");
    }
}