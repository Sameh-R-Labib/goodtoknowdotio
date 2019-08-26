<?php

namespace GoodToKnow\Controllers;

use function GoodToKnow\ControllerHelpers\standard_form_field_prep;

class NewCommunityProcessor
{
    function page()
    {
        global $is_logged_in;
        global $sessionMessage;

        kick_out_loggedoutusers();

        kick_out_onabort();

        require_once CONTROLLERHELPERS . DIRSEP . 'standard_form_field_prep.php';

        $community_name = standard_form_field_prep('community_name', 1, 200);

        $community_description = standard_form_field_prep('community_description', 1, 230);

        if (is_null($community_name) || is_null($community_description)) {
            breakout(' One or more values did not pass validation. ');
        }

        $_SESSION['saved_str01'] = $community_name;
        $_SESSION['saved_str02'] = $community_description;

        redirect_to("/ax1/NewCommunitySave/page");
    }
}