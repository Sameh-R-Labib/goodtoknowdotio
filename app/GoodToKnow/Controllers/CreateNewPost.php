<?php
/**
 * Created by PhpStorm.
 * User: samehlabib
 * Date: 9/28/18
 * Time: 4:56 PM
 */

namespace GoodToKnow\Controllers;


use GoodToKnow\Models\CommunityToTopic;


class CreateNewPost
{
    function page()
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
        global $community_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Refresh special_topic_array
         */
        $db = db_connect($sessionMessage);
        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }
        $special_topic_array = CommunityToTopic::get_topics_array_for_a_community($db, $sessionMessage, $community_id);
        if ($special_topic_array == false) $special_topic_array = [];
        $_SESSION['special_topic_array'] = $special_topic_array;
        $_SESSION['last_refresh_topics'] = time();

        // Abort if the community doesn't have any topics yet
        if (empty($special_topic_array)) {
            $sessionMessage .= " Aborted because you can't create a new post in a community which has no topics. ";
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which topic does the post go in?';

        require VIEWS . DIRSEP . 'createnewpost.php';
    }
}