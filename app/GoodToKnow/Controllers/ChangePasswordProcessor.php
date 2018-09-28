<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/28/18
 * Time: 1:47 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\User;


class ChangePasswordProcessor
{
    public function page()
    {
        global $user_id;
        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
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
        $current_password = (isset($_POST['current_password'])) ? $_POST['current_password'] : '';
        $first_try = (isset($_POST['first_try'])) ? $_POST['first_try'] : '';
        $new_password = (isset($_POST['new_password'])) ? $_POST['new_password'] : '';

        /**
         * Get the user object for the current user
         * and make sure $current_password is a
         * valid submission.
         */
        $user_object = User::find_by_id($db, $sessionMessage, $user_id);
        $hash_of_submitted_password = password_hash($current_password, PASSWORD_DEFAULT);
        if ($hash_of_submitted_password !== $user_object->password) {
            $sessionMessage .= " The value you entered as Current Password not correct. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }


        // Make sure to sanitize values used in $sql.
    }
}