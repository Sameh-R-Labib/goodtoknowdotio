<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/5/18
 * Time: 4:21 PM
 */

namespace GoodToKnow\Controllers;


class AdminCreateUser
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
        global $community_array;
        global $topic_id;
        global $page_id;
        global $saved_str01; // choice
        global $saved_str02;

        if (!$is_logged_in OR !$is_admin) {
            $_SESSION['message'] = $sessionMessage; // to pass message along since script doesn't output anything
            redirect_to("/ax1/LoginForm/page");
        }

        // choice
        $saved_str01 = (isset($_SESSION['saved_str01'])) ? $_SESSION['saved_str01'] : '';
    }
}