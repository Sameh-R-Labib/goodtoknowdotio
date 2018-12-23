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
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $special_community_array;

        if (!$is_logged_in OR $is_admin) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Control Panel';

        $page = 'CP';

        $show_poof = true;

        require VIEWS . DIRSEP . 'controlpanel.php';
    }
}