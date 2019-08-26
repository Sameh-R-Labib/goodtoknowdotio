<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;

class MemberMemoEditorForm
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
         *  1) Retrieve the User object for the member whose memo the admin wants to edit.
         *  2) Save the id of the User in the session.
         *  3) Present a (pre-filled with current memo) form for editing the memo.
         */

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }


        /**
         *  1) Retrieve the User object for the member whose memo the admin wants to edit.
         *  2) Save the id of the User in the session.
         */

        $user_object = User::find_by_username($db, $sessionMessage, $saved_str01);

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