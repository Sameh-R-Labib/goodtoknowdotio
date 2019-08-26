<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;

class SuspendAccountSuspend
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $saved_str01; // Has user's username

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }


        /**
         * Goals for this function:
         *  1) Retrieve the User object for the member
         *     whose is_suspended field the admin wants to edit.
         *  2) Change the value of is_suspended to 1.
         *  3) Save changes to User object. In other words update the User record in the database.
         *  4) Show a message indicating we've successfully suspended the user's account.
         */

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }


        /**
         * 1) Retrieve the User object for the member
         *     whose is_suspended field the admin wants to edit.
         */

        $user_object = User::find_by_username($db, $sessionMessage, $saved_str01);

        if (!$user_object) {
            breakout(' Unexpectedly unable to retrieve target user\'s object. ');
        }


        /**
         * 2) Change the value of is_suspended to 1.
         */

        $user_object->is_suspended = "1";


        /**
         * 3) Save changes to User object. In other words update the User record in the database.
         */

        $consequence_of_save = $user_object->save($db, $sessionMessage);

        if (!$consequence_of_save) {
            breakout(' The save failed. ');
        }

        if (!empty($sessionMessage)) {
            breakout(" The save method for User did not return false but it did send back a message.
             Therefore, it probably did not update {$saved_str01}'s account. ");
        }


        /**
         * 4) Show a message indicating we've successfully suspended the user's account.
         */

        breakout(" User {$saved_str01}'s account has been suspended 👍. ");
    }
}