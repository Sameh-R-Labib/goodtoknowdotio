<?php


namespace GoodToKnow\Controllers;


use function GoodToKnow\ControllerHelpers\standard_form_field_prep;


class NewCommunityProcessor
{
    function page()
    {
        global $is_logged_in;
        global $sessionMessage;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (isset($_POST['abort']) AND $_POST['abort'] === "Abort") {
            $sessionMessage .= " I aborted the task. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $community_name = standard_form_field_prep('community_name', 1, 200);

        $community_description = standard_form_field_prep('community_description', 1, 230);

        if (is_null($community_name) || is_null($community_description)) {
            $sessionMessage .= " One or more values did not pass validation. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $_SESSION['saved_str01'] = $community_name;
        $_SESSION['saved_str02'] = $community_description;

        redirect_to("/ax1/NewCommunitySave/page");
    }
}