<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-03-11
 * Time: 21:37
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\User;


class MemberMemoEditorForm
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $saved_str01; // Has user's username

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Goals for this function:
         *  1) Retrieve the User object for the member
         *     whose memo the admin wants to edit.
         *  2) Save the id of the User in the session.
         *  3) Present a (pre-filled with current memo)
         *     form for editing the memo.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         *  1) Retrieve the User object for the member
         *     whose memo the admin wants to edit.
         *  2) Save the id of the User in the session.
         */
        $user_object = User::find_by_username($db, $sessionMessage, $saved_str01);
        if (!$user_object) {
            $sessionMessage .= " Unexpected unable to retrieve target user's object. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $_SESSION['saved_int01'] = (int)$user_object->id;

        /**
         *  3) Present a (pre-filled with current memo)
         *     form for editing the memo.
         */
        $html_title = 'Member Memo Editor Form';

        require VIEWS . DIRSEP . 'membermemoeditorform.php';
    }
}