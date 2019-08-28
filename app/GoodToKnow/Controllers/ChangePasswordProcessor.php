<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;
use function GoodToKnow\ControllerHelpers\is_password_asapair;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class ChangePasswordProcessor
{
    function page()
    {
        global $user_id;
        global $is_logged_in;
        global $sessionMessage;

        kick_out_loggedoutusers();

        kick_out_onabort();

        $db = get_db();


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
            breakout(' One or more values you entered did not pass validation. ');
        }


        /**
         * Get the user object for the current user and make sure $current_password is a valid submission.
         */

        $user_object = User::find_by_id($db, $sessionMessage, $user_id);

        if (!password_verify($current_password, $user_object->password)) {
            breakout(' Invalid password. ');
        }


        /**
         * Make sure the new password pair is syntactically and as a pair are acceptable.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'is_password_asapair.php';

        $is_password = is_password_asapair($sessionMessage, $first_try, $new_password);

        if (!$is_password) {
            breakout(' The value you entered for a new password has something wrong with it. ');
        }


        /**
         * Put the hash of the new password in the user object.
         */

        $user_object->password = password_hash($new_password, PASSWORD_DEFAULT);


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