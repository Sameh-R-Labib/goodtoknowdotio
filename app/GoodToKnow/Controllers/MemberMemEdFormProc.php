<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-03-12
 * Time: 19:07
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\User;


class MemberMemEdFormProc
{
    public function page()
    {
        /**
         * The purpose is to:
         *  1) Read $_POST['text']
         *     (which is the edited member's comment.)
         *  2) Remove any HTML tags found in $_POST['text'].
         *  3) Validate the suitability of $_POST['text']
         *     as a User comment.
         *  4) Get a copy of the User object for the member.
         *  5) Makes sure the comment is escaped for suitability
         *     to being included in an sql statement. This may be
         *     taken care of automatically by the GoodObject class
         *     function I'll be using but make sure.
         *  6) Replace the User's current comment with the new one.
         *  7) Update the database with this User object.
         */

        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $saved_str01;                // The member's username
        global $saved_int01;                // The member's id

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Read $_POST['text']
         *    (which is the edited member's comment.)
         */
        $edited_comment = (isset($_POST['text'])) ? $_POST['text'] : '';
        if (!isset($_POST['text']) || trim($edited_comment) === '') {
            $sessionMessage .= " The edited comment was not saved because nothing (or blank space) was submitted. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * 2) Remove any HTML tags found in $_POST['text'].
         * 3) Validate the suitability of $_POST['text']
         *    as a User comment.
         */
        $result = AdminCreateUser::is_comment($sessionMessage, $edited_comment);
        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because the text submitted did not comply. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * 4) Get a copy of the User object for the member.
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }
        $user_object = User::find_by_id($db, $sessionMessage, $saved_int01);
        if (!$user_object) {
            $sessionMessage .= " Unexpected failed to retrieve the user object. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * 5) Makes sure the comment is escaped for suitability
         *    to being included in an sql statement. This may be
         *    taken care of automatically by the GoodObject class
         *    function I'll be using but make sure.
         *
         * Yes this is t.c.o. automatically. So, don't worry about it!
         */

        /**
         * 6) Replace the User's current comment with the new one.
         */
        $user_object->comment = $edited_comment;

        /**
         * 7) Update the database with this User object.
         */
        $result = $user_object->save($db, $sessionMessage);
        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because I failed at saving the updated user object. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         * Report success.
         */
        $sessionMessage .= " I have successfully updated {$saved_str01}'s record. ";
        $_SESSION['message'] = $sessionMessage;
        $_SESSION['saved_int01'] = 0;
        $_SESSION['saved_str01'] = "";
        redirect_to("/ax1/Home/page");
    }
}