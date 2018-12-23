<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/27/18
 * Time: 6:23 PM
 */

namespace GoodToKnow\Controllers;


class AdminHome
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;
        global $special_community_array;

        if (!$is_logged_in OR !$is_admin) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Admin';

        $page = 'Admin';

        $show_poof = true;

        $sessionMessage .= " Welcome to your Admin Control Panel. ";

        require VIEWS . DIRSEP . 'adminhome.php';
    }
}