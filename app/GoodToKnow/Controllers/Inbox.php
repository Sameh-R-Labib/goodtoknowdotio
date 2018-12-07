<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 11/30/18
 * Time: 6:28 PM
 */

namespace GoodToKnow\Controllers;


class Inbox
{
    public function page()
    {
        global $sessionMessage;
        global $is_logged_in;
        global $is_admin;
        global $special_community_array;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        $html_title = 'Inbox';

        require VIEWS . DIRSEP . 'inbox.php';
    }
}