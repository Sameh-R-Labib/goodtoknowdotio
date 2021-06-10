<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;

class UnsuspendAccountUnsuspend
{
    function page()
    {
        global $g;
        // $g->saved_str01 has user's username


        kick_out_nonadmins();


        /**
         * Goals for this function:
         *  1) Retrieve the User object for the member
         *     whose is_suspended field the admin wants to edit.
         *  2) Change the value of is_suspended to 0.
         *  3) Save changes to User object. In other words update the User record in the database.
         *  4) Show a message indicating we've successfully suspended the user's account.
         */


        /**
         * 1) Retrieve the User object for the member
         *     whose is_suspended field the admin wants to edit.
         */

        $g->db = get_db();

        $user_object = User::find_by_username($g->saved_str01);

        if (!$user_object) {

            breakout(' Unexpected unable to retrieve target user\'s object. ');

        }


        /**
         * 2) Change the value of is_suspended to 0.
         */

        $user_object->is_suspended = "0";


        /**
         * 3) Save changes to User object. In other words update the User record in the database.
         */

        $consequence_of_save = $user_object->save();

        if (!$consequence_of_save) {

            breakout(' The save method for User returned false. ');

        }

        if (!empty($g->message)) {

            breakout(" The save method for User did not return false but it did send back a message.
             Therefore, it probably did not update {$g->saved_str01}'s account. ");

        }


        /**
         * 4) Show a message indicating we've successfully suspended the user's account.
         */

        breakout(" User {$g->saved_str01}'s account has been <b>un</b>suspended! Yay 😅 🤟 ");
    }
}