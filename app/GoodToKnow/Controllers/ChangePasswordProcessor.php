<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/28/18
 * Time: 1:47 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class ChangePasswordProcessor
{
    function page()
    {
        global $user_id;
        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * We should have some post variables. These include:
         *  - current_password
         *  - first_try
         *  - new_password
         *  - submit
         */

        /**
         * I can't assume these post variables exist so I do the following.
         */
        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $current_password = standard_form_field_prep('current_password', 6, 264);

        $first_try = standard_form_field_prep('first_try', 6, 264);

        $new_password = standard_form_field_prep('new_password', 6, 264);

        if (is_null($current_password) || is_null($first_try) || is_null($new_password)) {
            $sessionMessage .= " One or more of the values you entered did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Get the user object for the current user
         * and make sure $current_password is a
         * valid submission.
         */
        $user_object = User::find_by_id($db, $sessionMessage, $user_id);

        if (!password_verify($current_password, $user_object->password)) {
            $sessionMessage .= " The value you entered as Current Password not correct. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * By running the AdminCreateUser::is_password method
         * we can make sure the new password is acceptable.
         */
        $is_password = AdminCreateUser::is_password($sessionMessage, $first_try, $new_password);
        if (!$is_password) {
            $sessionMessage .= " The values you entered for a new password have something wrong with them. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Put the hash of the new password in the user object.
         */
        $user_object->password = password_hash($new_password, PASSWORD_DEFAULT);

        // Save the user object
        $is_saved = $user_object->save($db, $sessionMessage);
        if (!$is_saved || !empty($sessionMessage)) {
            $sessionMessage .= " Failed to update your record. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Report success and redirect.
         */
        $sessionMessage .= " Your password change has been saved. ";
        $_SESSION['message'] = $sessionMessage;
        redirect_to("/ax1/Home/page");
    }
}