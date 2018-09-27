<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/27/18
 * Time: 1:55 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\UserToCommunity;

class DefaultCommunityProcessor
{
    public function page()
    {
        global $user_id;
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $special_community_array;

        if (!$is_logged_in OR $is_admin) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (empty($_POST['choice'])) {
            $sessionMessage .= " Expected submission of choice not found. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Make sure the submitted choice is valid for this user.
         */
        $is_found = false;
        if (array_key_exists($_POST['choice'], $special_community_array)) $is_found = true;
        if (!$is_found) {
            $sessionMessage .= " Choice is not valid. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Update the user's record with the new default community id
         */

        /**
         * Get the user object from the database.
         */
        $db = db_connect($sessionMessage);
        $user_object = UserToCommunity::find_by_id($db, $sessionMessage, $user_id);
        if (!$user_object) {
            $sessionMessage .= " Expected submission of choice not found. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }
}