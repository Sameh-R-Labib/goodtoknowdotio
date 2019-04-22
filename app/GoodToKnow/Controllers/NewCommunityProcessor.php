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

        $community_name = (isset($_POST['community_name'])) ? $_POST['community_name'] : '';
        $community_description = (isset($_POST['community_description'])) ? $_POST['community_description'] : '';

        $community_name = trim($community_name);
        $community_description = trim($community_description);
    }
}