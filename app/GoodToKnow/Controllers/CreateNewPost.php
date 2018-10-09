<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/28/18
 * Time: 4:56 PM
 */

namespace GoodToKnow\Controllers;


class CreateNewPost
{
    public function page()
    {
        /**
         * This is the first of a series of routes
         * aimed at creating a new post.
         *
         * The first task is that of presenting a
         * form for getting the user to tell us
         * which topic the post belongs in.
         */
        global $is_logged_in;
        global $sessionMessage;
        global $special_topic_array;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        if (empty($special_topic_array)) {
            $sessionMessage .= " Aborted! The reason is you can't create a new post if your community has no topics. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which topic does the post go in?';

        require VIEWS . DIRSEP . 'createnewpost.php';
    }
}