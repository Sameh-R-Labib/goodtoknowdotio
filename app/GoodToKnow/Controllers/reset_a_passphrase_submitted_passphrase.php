<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\user;
use function GoodToKnow\ControllerHelpers\password_for_regandchange_prep;

class reset_a_passphrase_submitted_passphrase
{
    function page()
    {
        /**
         * We have saved_str_01. Which is the username.
         * We have first_try and password. Which give us the passphrase admin entered.
         *
         * Here, we need to make sure the password is valid.
         * If it is then update the database.
         * If it is NOT then redirect to the route which presents the form for entering the password
         * so that admin can try again.
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        /**
         * Get the passphrase admin submitted.
         * If there is something wrong with it then a breakout occurs.
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'password_for_regandchange_prep.php';

        $password = password_for_regandchange_prep();


        /**
         * Get the user object for the user whose passphrase we are resetting.
         */

        $user_object = user::find_by_username($g->saved_str01);


        /**
         * Put the hash of the new password in the user object.
         */

        $user_object->password = password_hash($password, PASSWORD_DEFAULT);

        // Save the user object

        $is_saved = $user_object->save();

        if (!$is_saved) {

            breakout(" Failed to update $user_object->username's record with passphrase $password. ");

        }


        /**
         * Report success and redirect.
         */

        breakout(" The passphrase for $user_object->username has been reset to $password. ");
    }
}