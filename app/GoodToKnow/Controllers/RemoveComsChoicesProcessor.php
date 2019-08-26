<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\UserToCommunity;

class RemoveComsChoicesProcessor
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $saved_str01; // Has user's username
        global $saved_int01; // Has user's id

        kick_out_nonadmins();

        kick_out_onabort();

        $db = get_db();


        /**
         * Now we know the ids of the communities which the administrator
         * doesn't want the user to belong to. The goal is to remove these
         * communities to the user.
         */

        /**
         * $_POST array looks something like this:
         *
         * array(4) {
         *   ["choice-16"]=> string(2) "23"
         *   ["choice-18"]=> string(2) "25"
         *   ["choice-24"]=> string(1) "8"
         *   ["submit"]=> string(6) "Submit"
         * }
         *
         * Instead what we need is an array like this:
         *
         * array(4) {
         *   [0]=> string(1) "23"
         *   [1]=> string(1) "25"
         *   [2]=> string(2) "8"
         * }
         */

        if (!isset($_POST) || empty($_POST) || !is_array($_POST)) {
            breakout(' Unexpected deficiencies in the _POST array. ');
        }

        $submitted_community_ids_array = [];

        foreach ($_POST as $item) {
            if (is_numeric($item)) $submitted_community_ids_array[] = $item;
        }

        if (empty($submitted_community_ids_array)) {
            breakout(' You did not submit any community ids. ');
        }


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

            $array_with_one_element = UserToCommunity::find_by_sql($db, $sessionMessage, $sql);

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

            $result_of_delete = $object->delete($db, $sessionMessage);

            if (!$result_of_delete) {
                breakout(' Failed to delete User To Community. ');
            }

        }


        /**
         * Declare success.
         */

        breakout(" {$saved_str01}'s to-be-removed communities were removed! ");
    }
}