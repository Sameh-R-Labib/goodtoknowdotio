<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/12/18
 * Time: 10:06 PM
 */

namespace GoodToKnow\Controllers;


class AdminDebugShowSession
{
    public function page()
    {
        global $is_logged_in;
        global $is_admin;
        global $sessionMessage;

        if (!$is_logged_in OR !$is_admin) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            redirect_to("/ax1/LoginForm/page");
        }

        $html_title = 'Show Session';

        require VIEWS . DIRSEP . 'admindebugshowsession.php';
    }
}