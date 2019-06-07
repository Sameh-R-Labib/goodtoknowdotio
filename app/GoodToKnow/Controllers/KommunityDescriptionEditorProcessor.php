<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\Community;


class KommunityDescriptionEditorProcessor
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Goal:
         *  1) Validate $_POST['community']
         *  2) Save $_POST['community'] in the session.
         *  3) Redirect to a route.
         */

        $submitted_community_name = (isset($_POST['community'])) ? $_POST['community'] : '';

        if (trim($submitted_community_name) === "") {
            $sessionMessage .= " Aborted because you have not submitted a community name. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $community = Community::find_by_community_name($db, $sessionMessage, $submitted_community_name);
        if (!$community) {
            $sessionMessage .= " Unable to retrieve community object (possibly because the name you gave was invalid.) ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_int01'] = (int)$community->id;
        $_SESSION['saved_str01'] = $submitted_community_name;

        redirect_to("/ax1/KommunityDescriptionEditorForm/page");
    }
}