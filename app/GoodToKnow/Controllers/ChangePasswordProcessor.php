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
         * Debug Code
         */
        echo "\n<p>This should be the value I entered for current password</p>\n";
        echo "<br><p>Var_dump \$current_password: </p>\n<pre>";
        var_dump($current_password);
        echo "</pre>\n";




        /**
         * Get the user object for the current user
         * and make sure $current_password is a
         * valid submission.
         */
        $user_object = User::find_by_id($db, $sessionMessage, $user_id);
        $hash_of_submitted_password = password_hash($current_password, PASSWORD_DEFAULT);
        if ($hash_of_submitted_password !== $user_object->password) {


            /**
             * Debug Code
             */
            echo "\n<p>Obviously the hashes didn't match. But why?</p>\n";
            echo "<br><p>Var_dump \$hash_of_submitted_password: </p>\n<pre>";
            var_dump($hash_of_submitted_password);
            echo "</pre>\n";
            echo "<br><p>Var_dump \$user_object->password: </p>\n<pre>";
            var_dump($user_object->password);
            echo "</pre>\n";
            die("<br><p>End debug</p>\n");



            $sessionMessage .= " The value you entered as Current Password not correct. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }


        /**
         * Debug
         */
        die("<p>So the current password is the new one already.</p>");





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