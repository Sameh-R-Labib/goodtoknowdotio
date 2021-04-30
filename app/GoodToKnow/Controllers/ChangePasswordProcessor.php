<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\password_for_regandchange_prep;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class ChangePasswordProcessor
{
    function page()
    {
        global $user_id;
        global $sessionMessage;
        global $db;

        kick_out_loggedoutusers();

        $db = get_db();


        /**
         * Process the submitted form values for:
         *  - current_password
         *  - first_try
         *  - password
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $current_password = standard_form_field_prep('current_password', 10, 264);

        require_once CONTROLLERHELPERS . DIRSEP . 'password_for_regandchange_prep.php';

        $password = password_for_regandchange_prep();


        /**
         * Get the user object for the current user and make sure $current_password is a valid submission.
         */

        $user_object = User::find_by_id($db, $sessionMessage, $user_id);

        if (!password_verify($current_password, $user_object->password)) {

            breakout(' Invalid password. ');

        }


        /**
         * Put the hash of the new password in the user object.
         */

        $user_object->password = password_hash($password, PASSWORD_DEFAULT);


        // Save the user object

        $is_saved = $user_object->save($db, $sessionMessage);

        if (!$is_saved || !empty($sessionMessage)) {

            breakout(' Failed to update your record. ');

        }


        /**
         * Report success and redirect.
         */

        breakout(' Your password has been changed. ');
    }
}