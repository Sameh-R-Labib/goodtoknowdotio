<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/27/18
 * Time: 1:55 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\integer_form_field_prep;


class DefaultCommunityProcessor
{
    function page()
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
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        require_once CONTROLLERHELPERS . DIRSEP . 'integer_form_field_prep.php';

        // int(10) in mysql has max 4294967295
        $chosen_id = integer_form_field_prep('choice', 1, 4294967295);

        if (is_null($chosen_id)) {
            $sessionMessage .= " Your choice did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Make sure the submitted choice is valid for this user.
         */
        $is_found = false;

        if (array_key_exists($chosen_id, $special_community_array)) $is_found = true;

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
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}