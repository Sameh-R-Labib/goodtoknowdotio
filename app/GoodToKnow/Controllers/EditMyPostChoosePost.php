<?php


namespace GoodToKnow\Controllers;


use GoodToKnow\Models\TopicToPost;


class EditMyPostChoosePost
{
    public function page()
    {
        /**
         * The goal is to present a form
         * with radio buttons for the user
         * to choose the post to edit.
         * Since users can ONLY edit posts
         * which they have created they
         * will ONLY see those.
         * We are ONLY presenting posts
         * found in the topic which was
         * already selected.
         * If we can't find any posts
         * which meet the criteria then
         * we'll store a session message
         * and redirect back home.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;        // id of topic
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            $sessionMessage .= ' Database connection failed. ';
            $_SESSION['message'] = $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        // Get all posts (as special array) for the user and topic.
        $special_post_array = TopicToPost::special_posts_array_for_user_and_topic($db, $sessionMessage, $user_id, $saved_int01);

        if (!$special_post_array) {
            $sessionMessage .= " There are NO posts for YOU to edit here. ";
            $_SESSION['message'] .= $sessionMessage;
            redirect_to("/ax1/Home/page");
        }

        /**
         * Allow user to choose from amongst
         * the posts which remain.
         */

        $html_title = 'Which post to edit?';

        require VIEWS . DIRSEP . 'editmypostchoosepost.php';
    }
}