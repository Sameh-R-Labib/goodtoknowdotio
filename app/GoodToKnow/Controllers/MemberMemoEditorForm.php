<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;

class MemberMemoEditorForm
{
    function page()
    {
        global $db;
        global $sessionMessage;
        global $saved_str01; // Has user's username. Is changed in this file and is used in the view.
        global $html_title;
        global $user_object;


        kick_out_nonadmins();


        /**
         * Goals for this function:
         *  1) Retrieve the User object for the member whose memo the admin wants to edit.
         *  2) Save the id of the User in the session.
         *  3) Present a (pre-filled with current memo) form for editing the memo.
         */


        /**
         *  1) Retrieve the User object for the member whose memo the admin wants to edit.
         *  2) Save the id of the User in the session.
         */

        $db = get_db();

        $user_object = User::find_by_username($saved_str01);

        if (!$user_object) {

            breakout(' Unexpected unable to retrieve target user\'s object. ');

        }

        $_SESSION['saved_int01'] = (int)$user_object->id;


        /**
         *  3) Present a (pre-filled with current memo) form for editing the memo.
         *
         *  $user_object->comment
         *     is to be used to pro-populate the form.
         */

        $html_title = 'Member Memo Editor Form';

        require VIEWS . DIRSEP . 'membermemoeditorform.php';
    }
}