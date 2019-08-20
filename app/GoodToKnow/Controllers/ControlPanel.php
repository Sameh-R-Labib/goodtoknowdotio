<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/26/18
 * Time: 10:05 PM
 */

namespace GoodToKnow\Controllers;


class ControlPanel
{
    function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $special_community_array;
        global $type_of_resource_requested;

        if (!$is_logged_in OR $is_admin) {
            $_SESSION['message'] = $sessionMessage;
            reset_feature_session_vars();
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Control Panel';

        $page = 'CP';

        $show_poof = true;

        $sessionMessage .= " Welcome to your Control Panel. ";

        require VIEWS . DIRSEP . 'controlpanel.php';
    }
}