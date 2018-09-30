<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/30/18
 * Time: 1:56 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\TopicToPost;


class CreateNewPostInsertPoint
{
    public function page()
    {
        /**
         * The goal is to present a form
         * for specifying the location for
         * inserting the new post.
         * The user answers two questions:
         *  1) Before or After?
         *  2) Which post?
         */
        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;

        if (!$is_logged_in) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * $saved_int01 should be the id of a topic
         * This topic is the one the user is choosing
         * for her new post.
         *
         * Before we can present the form we need to
         * have a special post array so we can list
         * all the posts in said topic.
         */
        $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($db, $sessionMessage, $saved_int01);
        if (!$special_post_array) {
            $sessionMessage .= " Unable to get posts for the topic specified. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Where will the new post go?';

        require VIEWS . DIRSEP . 'createnewpostinsertpoint.php';
    }
}