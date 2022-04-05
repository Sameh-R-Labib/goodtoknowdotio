<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\user_to_community;

class remove_coms_choices_processor
{
    function page()
    {
        global $g;
        // $g->saved_str01 has user's username
        // $g->saved_int01 has user's id


        kick_out_nonadmins_or_if_there_is_error_msg();


        require CONTROLLERINCLUDES . DIRSEP . 'get_the_submitted_community_ids.php';


        /**
         * Generally speaking for each comm id that was submitted
         * remove its community from the user.
         */

        /**
         * "The user" -- means The user we are attempting to remove new groups from.
         *
         * We know:
         *   saved_str01 -- contains the username
         *   saved_int01 -- contains the id of the user
         */

        /**
         * More specifically what we need to do is
         * delete the rows of the user_to_community db table
         * which have a user_id == $g->saved_int01
         * and any of the comm ids found in the $g->submitted_community_ids_array.
         *
         * To accomplish this:
         *   1) I will retrieve the pertinent user_to_community objects.
         *   2) One-by-one I'll delete them.
         */

        /**
         * $usertocommunity_objects_array
         *   will hold the user_to_community objects I retrieve from the database.
         */

        $usertocommunity_objects_array = [];

        get_db();

        foreach ($g->submitted_community_ids_array as $a_community_id) {

            /**
             * Retrieve and add the user_to_community object
             * whose user_id == $g->saved_int01 and community_id == $a_community_id
             */

            $sql = 'SELECT *
                    FROM `user_to_community`
                    WHERE `user_id` = "' . $g->db->real_escape_string((string)$g->saved_int01) .
                '" AND `community_id` = "' . $g->db->real_escape_string((string)$a_community_id) .
                '" LIMIT 1';

            $array_with_one_element = user_to_community::find_by_sql($sql);

            if (!$array_with_one_element || empty($array_with_one_element) || empty($array_with_one_element[0])) {

                breakout(' Error 0819. ');

            }

            $usertocommunity_objects_array[] = $array_with_one_element[0];
        }


        /**
         * So at this point we should have a $usertocommunity_objects_array
         * whereupon we can iterate and delete each user_to_community object
         * from the db table user_to_community.
         */

        foreach ($usertocommunity_objects_array as $object) {

            $result_of_delete = $object->delete();

            if (!$result_of_delete) {

                breakout(' Failed to delete user_to_community. ');

            }

        }


        /**
         * Declare success.
         */

        breakout(" $g->saved_str01's to-be-removed communities were removed! ");
    }
}