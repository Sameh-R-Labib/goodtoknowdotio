<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\user;

class member_memo_editor_form
{
    function page()
    {
        global $g;
        // $g->saved_str01 has user's username. Is changed in this file and is used in the view.


        kick_out_nonadmins_or_if_there_is_error_msg();


        /**
         * Goals for this function:
         *  1) Retrieve the user object for the member whose memo the Admin wants to edit.
         *  2) Save the id of the user in the session.
         *  3) Present a (pre-filled with current memo) form for editing the memo.
         */


        /**
         *  1) Retrieve the user object for the member whose memo the Admin wants to edit.
         *  2) Save the id of the user in the session.
         */

        get_db();

        $g->user_object = user::find_by_username($g->saved_str01);

        if (!$g->user_object) {

            breakout(' Unexpected unable to retrieve target user object. ');

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