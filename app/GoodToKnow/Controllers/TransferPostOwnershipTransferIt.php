<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Post;
use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class TransferPostOwnershipTransferIt
{
    function page()
    {
        /**
         * Last function for TransferPostOwnershipTransferIt.
         *
         * Here we take the username submitted and use it to
         * make its id part of the record for for the post.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $saved_int02;  // Post id

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $username = standard_form_field_prep('username', 7, 12);

        if (is_null($username)) {
            $sessionMessage .= " The username you entered did NOT pass validation. ";
            $_SESSION['message'] .= $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        // Get the user id which corresponds with the username.
        $user_object = User::find_by_username($db, $sessionMessage, $username);

        if (!$user_object) {
            $sessionMessage .= " Unexpected unable to retrieve target user's object. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $user_id = (int)$user_object->id;

        // Get the Post object.
        $post_object = Post::find_by_id($db, $sessionMessage, $saved_int02);

        if (!$post_object) {
            $sessionMessage .= " TransferPostOwnershipTransferIt::page says: Unexpected could not get a post object. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        // Change the user_id to that of the new person.
        $post_object->user_id = $user_id;

        // Save the Post to the database.
        $result = $post_object->save($db, $sessionMessage);

        if ($result === false) {
            $sessionMessage .= " I was unable to save the updated post record. ";
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        // Report success.
        $sessionMessage .= " I've updated \"{$post_object->title}\" post's record to belong to <b>{$username}</b>. ";
        $_SESSION['message'] = $sessionMessage;
        reset_feature_session_vars();
        redirect_to("/ax1/Home/page");
    }
}