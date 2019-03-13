<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 2019-03-12
 * Time: 19:07
 */

namespace GoodToKnow\Controllers;


class MemberMemEdFormProc
{
    public function page()
    {
        /**
         * The purpose is to:
         *  1) Read $_POST['plaintext']
         *     (which is the edited member's comment.)
         *  2) Remove any HTML tags found in $_POST['plaintext'].
         *  3) Validate the suitability of $_POST['plaintext']
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
        global $sessionMessage;
        global $saved_str01;                // The member's username
        global $saved_int01;                // The member's id

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 1) Read $_POST['plaintext']
         *    (which is the edited member's comment.)
         */
        $edited_comment = (isset($_POST['plaintext'])) ? $_POST['plaintext'] : '';
        if (!isset($_POST['plaintext']) || trim($edited_comment) === '') {
            $sessionMessage .= " The edited comment was not saved because nothing (or blank space) was submitted. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * 2) Remove any HTML tags found in $_POST['plaintext'].
         * 3) Validate the suitability of $_POST['plaintext']
         *    as a User comment.
         */
        $result = AdminCreateUser::is_comment($sessionMessage, $edited_comment);
        if ($result === false) {
            $sessionMessage .= " I aborted the process you were working on because the text submitted did not comply. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
    }
}