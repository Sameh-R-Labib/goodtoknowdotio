<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/27/18
 * Time: 1:55 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\User;


class DefaultCommunityProcessor
{
    public function page()
    {
        global $user_id;
        global $is_logged_in;
        global $sessionMessage;
        global $special_community_array;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You have aborted the task you were working on! The session variables were reset. ";
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
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $user_object = User::find_by_id($db, $sessionMessage, $user_id);
        if (!$user_object) {
            $sessionMessage .= " Expected submission of choice not found. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $user_object->id_of_default_community = $_POST['choice'];
        $was_updated = $user_object->save($db, $sessionMessage);
        if (!$was_updated) {
            $sessionMessage .= " Failed to update your user record. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // User will know default community by logging out then in.
        $sessionMessage .= " Your default community has been changed to {$special_community_array[$_POST['choice']]}. ";
        redirect_to("/ax1/Home/page");
    }
}