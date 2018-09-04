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
        global $user_id;              // int value
        global $role;                 // string value
        global $community_name;       // string value
        global $community_id;         // int value
        global $community_array;      // array of objects (Communities the user belongs to)
        global $topic_id;             // int value
        global $page_id;              // int value
        global $saved_str01;          // string value (temporary storage)
        global $saved_str02;

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