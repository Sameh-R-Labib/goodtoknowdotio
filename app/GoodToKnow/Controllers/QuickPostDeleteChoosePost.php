<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\TopicToPost;


class QuickPostDeleteChoosePost
{
    function page()
    {
        /**
         * The goal is to present a form
         * with radio buttons for admin
         * to choose the post to delete.
         * We are ONLY presenting posts
         * found in the topic which was
         * already selected.
         * If we can't find any posts then
         * we'll store a session message
         * and redirect back home.
         *
         * For each post we will show the
         * complete name of the post along
         * with the username of its author.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $saved_int01;        // id of topic

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $array_of_post_objects = TopicToPost::get_posts_array_for_a_topic($db, $sessionMessage, $saved_int01);

        if (!$array_of_post_objects) {
            $sessionMessage .= " This topic doesn't contain any posts. ";
            $_SESSION['message'] .= $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Generate an array of author usernames.
         * Each array element's value is a username which
         * is the username corresponding to the user_id
         * of the corresponding element in the
         * $array_of_post_objects.
         */
        $array_of_author_usernames = TopicToPost::get_author_usernames($db, $sessionMessage, $array_of_post_objects);

        if (!$array_of_author_usernames) {
            $sessionMessage .= " Anomalous condition: Supposedly we have posts but do not have any authors. ";
            $_SESSION['message'] .= $sessionMessage;
            $_SESSION['saved_int01'] = 0;
            redirect_to("/ax1/Home/page");
        }

        $html_title = 'Which post to delete?';

        require VIEWS . DIRSEP . 'quickpostdeletechoosepost.php';
    }
}