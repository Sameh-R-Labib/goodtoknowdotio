<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\User;

class MemberMemoEditorForm
{
    function page()
    {
        global $g;
        // $g->saved_str01 has user's username. Is changed in this file and is used in the view.


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

        get_db();

        $g->user_object = User::find_by_username($g->saved_str01);

        if (!$g->user_object) {

            breakout(' Unexpected unable to retrieve target user\'s object. ');

        }

        $_SESSION['saved_int01'] = (int)$g->user_object->id;


        /**
         *  3) Present a (pre-filled with current memo) form for editing the memo.
         *
         *  $user_object->comment
         *     is to be used to pro-populate the form.
         */

        $g->html_title = 'Member Memo Editor Form';

        require VIEWS . DIRSEP . 'membermemoeditorform.php';
    }
}