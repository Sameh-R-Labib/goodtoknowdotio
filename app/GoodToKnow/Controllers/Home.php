<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 8/22/18
 * Time: 9:09 PM
 */

namespace GoodToKnow\Controllers;


class Home
{
    public function page()
    {
        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $user_id;
        global $role;
        global $community_name;
        global $community_id;
        global $community_name_array;
        global $topic_id;
        global $page_id;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/LoginForm/page");
        }

        $html_title = 'GoodToKnow.io';


        require TOP;

        require VIEWS . DIRSEP . 'homepage.php';

        require BOTTOM;
    }
}