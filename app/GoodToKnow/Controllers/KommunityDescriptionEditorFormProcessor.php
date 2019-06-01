<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Community;


class KommunityDescriptionEditorFormProcessor
{
    public function page()
    {
        /**
         * The purpose is to:
         *  1) Read $_POST['text']
         *     (which is the edited community's description.)
         *  2) Remove any HTML tags found in $_POST['text'].
         *  3) Validate the suitability of $_POST['text']
         *     as a community description.
         *  4) Get a copy of the Community object.
         *  5) Makes sure the description is escaped for suitability
         *     to being included in an sql statement. This may be
         *     taken care of automatically by the GoodObject class
         *     function I'll be using but make sure.
         *  6) Replace the Community's current description with the new one.
         *  7) Update the database with this Community object.
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
            $sessionMessage .= " You have aborted the task you were working on! The session variables were reset. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         *  1) Read $_POST['text']
         *     (which is the edited community's description.)
         */
        $edited_description = (isset($_POST['text'])) ? $_POST['text'] : '';
        if (!isset($_POST['text']) || trim($edited_description) === '') {
            $sessionMessage .= " The edited comment was not saved because nothing (or blank space) was submitted. ";
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            $_SESSION['saved_str01'] = "";
            redirect_to("/ax1/Home/page");
        }

        /**
         *  2) Remove any HTML tags found in $_POST['text'].
         *  3) Validate the suitability of $_POST['text']
         *     as a community description.
         */
        $result = Community::is_community_description($sessionMessage, $edited_description);
    }
}