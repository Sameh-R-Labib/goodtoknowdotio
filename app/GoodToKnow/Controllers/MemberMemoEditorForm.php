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
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_str01'] = "";
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
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_str01'] = "";
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
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }
        $_SESSION['saved_int01'] = (int)$user_object->id;

        /**
         *  3) Present a (pre-filled with current memo)
         *     form for editing the memo.
         *
         *  $user_object->comment
         *     is to be used to pro-populate the form.
         */
        $html_title = 'Member Memo Editor Form';

        require VIEWS . DIRSEP . 'membermemoeditorform.php';
    }
}