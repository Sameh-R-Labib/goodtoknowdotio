<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\user;
use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class member_mem_ed_form_proc
{
    function page()
    {
        /**
         * The purpose is to:
         *  1) Read 'text'
         *     (which is the edited member's comment.)
         *  2 & 3) Removed from source code.
         *  4) Get a copy of the user object for the member.
         *  5) Makes sure the comment is escaped for suitability
         *     to being included in an sql statement. This may be
         *     taken care of automatically by the good_object class
         *     function I'll be using but make sure.
         *  6) Replace the user's current comment with the new one.
         *  7) Update the database with this user object.
         */


        global $g;
        // $g->saved_str01 the member's username
        // $g->saved_int01 the member's id


        kick_out_nonadmins();


        /**
         * 1) Read 'text'
         *    (which is the edited member's comment.)
         */

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $edited_comment = standard_form_field_prep('comment', 0, 1800);


        /**
         * 4) Get a copy of the user object for the member.
         */

        get_db();

        $user_object = user::find_by_id($g->saved_int01);

        if (!$user_object) {

            breakout(' Unexpected failed to retrieve the user object. ');

        }


        /**
         * 5) Makes sure the comment is escaped for suitability to being included in an sql statement. This may be
         *    taken care of automatically by the good_object class function I'll be using but make sure.
         *
         * Yes this is t.c.o. automatically. So, don't worry about it!
         */


        /**
         * 6) Replace the user's current comment with the new one.
         */

        $user_object->comment = $edited_comment;


        /**
         * 7) Update the database with this user object.
         */

        $result = $user_object->save();

        if ($result === false) {

            breakout(' I failed at updating user record. ');

        }


        /**
         * Report success.
         */

        breakout(" I updated <b>$g->saved_str01</b>'s record. ");
    }
}