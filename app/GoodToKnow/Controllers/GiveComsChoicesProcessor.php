<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-01-13
 * Time: 22:01
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\UserToCommunity;

class GiveComsChoicesProcessor
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $saved_str01; // Has user's username
        global $saved_int01; // Has user's id

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Now we know the ids of the communities the administrator
         * wants the user to belong to. The goal is to assign these
         * communities to the user.
         */

        /**
         * $_POST array looks something like this:
         *
         * array(5) {
         *   ["choice-1"]=> string(1) "3"
         *   ["choice-2"]=> string(1) "8"
         *   ["choice-3"]=> string(2) "12"
         *   ["choice-4"]=> string(2) "15"
         *   ["submit"]=> string(6) "Submit"
         * }
         */

        /**
         * Instead what we need is an array like this:
         *
         * array(4) {
         *   [0]=> string(1) "3"
         *   [1]=> string(1) "8"
         *   [2]=> string(2) "12"
         *   [3]=> string(2) "15"
         * }
         */

        if (!isset($_POST) || empty($_POST) || !is_array($_POST)) {
            $sessionMessage .= " Unexpected deficiencies in the _POST array. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        $submitted_community_ids_array = [];
        foreach ($_POST as $item) {
            if (is_numeric($item)) {
                $submitted_community_ids_array[] = $item;
            }
        }

        if (empty($submitted_community_ids_array)) {
            $sessionMessage .= " You did not submit any community ids. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

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
         * This loop will generate an array of UserToCommunity objects
         * to be used by the UserToCommunity::insert_multiple_objects method
         * so that we can insert all the UserToCommunity objects at once
         * instead of individually.
         */
        $array_of_usertocommunity_objects = [];
        foreach ($submitted_community_ids_array as $a_community_id) {
            $a_community_id = (int)$a_community_id;
            $usertocommunity_object_as_array = ['user_id' => $saved_int01, 'community_id' => $a_community_id];
            $array_of_usertocommunity_objects[] = UserToCommunity::array_to_object($usertocommunity_object_as_array);
        }

        /**
         * $array_of_usertocommunity_objects
         * Tested Good
         */

        /**
         * The goal now is to insert all these objects into the database.
         */
        $result = UserToCommunity::insert_multiple_objects($db, $sessionMessage, $array_of_usertocommunity_objects);
        if (!$result) {
            $sessionMessage .= " In GiveComsChoicesProcessor encountered error due to
            UserToCommunity::array_to_object being unable to save the user_to_community records. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Declare success.
         */
        $_SESSION['message'] = $sessionMessage . " {$saved_str01}'s new communities were assigned to {$saved_str01}! ";
        $_SESSION['saved_int01'] = 0;
        $_SESSION['saved_str01'] = "";
        redirect_to("/ax1/Home/page");
    }
}