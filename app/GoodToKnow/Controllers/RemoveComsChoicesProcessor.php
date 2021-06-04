<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\UserToCommunity;

class RemoveComsChoicesProcessor
{
    function page()
    {
        global $db;
        global $app_state;
        // $app_state->saved_str01 has user's username
        global $saved_int01; // Has user's id
        global $submitted_community_ids_array;


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_submitted_community_ids.php';


        /**
         * Generally speaking for each comm id that was submitted
         * remove its community from the user.
         */

        /**
         * "The user" -- means The User we are attempting to remove new groups from.
         *
         * We know:
         *   saved_str01 -- contains the username
         *   saved_int01 -- contains the id of the user
         */

        /**
         * More specifically what we need to do is
         * delete the rows of the user_to_community db table
         * which have a user_id == $saved_int01
         * and any of the comm ids found in the $submitted_community_ids_array.
         *
         * To accomplish this:
         *   1) I will retrieve the pertinent UserToCommunity objects.
         *   2) One-by-one I'll delete them.
         */

        /**
         * $usertocommunity_objects_array
         *   will hold the UserToCommunity objects I retrieve from the database.
         */

        $usertocommunity_objects_array = [];

        $db = get_db();

        foreach ($submitted_community_ids_array as $a_community_id) {

            /**
             * Retrieve and add the UserToCommunity object
             * whose user_id == $saved_int01 and community_id == $a_community_id
             */

            $sql = 'SELECT *
                    FROM `user_to_community`
                    WHERE `user_id` = "' . $db->real_escape_string($saved_int01) .
                '" AND `community_id` = "' . $db->real_escape_string($a_community_id) .
                '" LIMIT 1';

            $array_with_one_element = UserToCommunity::find_by_sql($sql);

            if (!$array_with_one_element || empty($array_with_one_element) || empty($array_with_one_element[0])) {

                breakout(' Error 0819. ');

            }

            $usertocommunity_objects_array[] = $array_with_one_element[0];
        }


        /**
         * So at this point we should have a $usertocommunity_objects_array
         * whereupon we can iterate and delete each UserToCommunity object
         * from the db table user_to_community.
         */

        foreach ($usertocommunity_objects_array as $object) {

            $result_of_delete = $object->delete();

            if (!$result_of_delete) {

                breakout(' Failed to delete User To Community. ');

            }

        }


        /**
         * Declare success.
         */

        breakout(" $app_state->saved_str01's to-be-removed communities were removed! ");
    }
}