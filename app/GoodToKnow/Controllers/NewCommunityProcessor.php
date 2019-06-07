<?php


namespace GoodToKnow\Controllers;


class NewCommunityProcessor
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " You've aborted the task! Session variables reset. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $community_name = (isset($_POST['community_name'])) ? $_POST['community_name'] : '';
        $community_description = (isset($_POST['community_description'])) ? $_POST['community_description'] : '';

        $community_name = trim($community_name);
        $community_description = trim($community_description);

        if (empty($community_name) || empty($community_description)) {
            $sessionMessage .= " Either you did not fill out the input fields or the session expired. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $community_name = htmlspecialchars($community_name, ENT_NOQUOTES | ENT_HTML5);
        $community_description = htmlspecialchars($community_description, ENT_NOQUOTES | ENT_HTML5);

        if (strlen($community_name) > 200 || strlen($community_description) > 230) {
            $sessionMessage .= " Either your community name or description was too long. Start over. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_str01'] = $community_name;
        $_SESSION['saved_str02'] = $community_description;

        redirect_to("/ax1/NewCommunitySave/page");
    }
}