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
        session_start();

        /**
         * Get data from the session
         */
        $message = (isset($_SESSION['message'])) ? $_SESSION['message'] : '';
        $user_id = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;
        $role = (isset($_SESSION['role'])) ? $_SESSION['role'] : '';
        // The name of community which the user wants to see.
        $community_name = (isset($_SESSION['community_name'])) ? $_SESSION['community_name'] : '';
        // The names of communities the user belongs to.
        $community_name_array = (isset($_SESSION['community_name_array'])) ? $_SESSION['community_name_array'] : [];
        $community_id = (isset($_SESSION['community_id'])) ? $_SESSION['community_id'] : 0;
        $topic_id = (isset($_SESSION['topic_id'])) ? $_SESSION['topic_id'] : 0;
        $page_id = (isset($_SESSION['page_id'])) ? $_SESSION['page_id'] : 0;

        /**
         * Deduce information from session data
         */
        $is_logged_in = (!empty($user_id)) ? true : false;
        $is_bubba = ($role === 'bubba') ? true : false;

        /**
         * Show the page
         */
        $html_title = 'GoodToKnow.io';

        require VIEWSINCLUDES . 'top.php';
        require VIEWS . 'homepage.php';
        require VIEWSINCLUDES . 'bottom.php';
    }
}