<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TopicToPost;

class AuthorDeletesOwnPostChoosePost
{
    function page()
    {
        /**
         * The goal is to present a form with radio buttons for the user to choose the post to delete. Since users can
         * ONLY delete posts which they have created they will ONLY see those. We are ONLY presenting posts found in the
         * topic which was already selected.
         *
         * If we can't find any posts which meet the criteria then
         * we'll store a session message and redirect back home.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $saved_int01;        // id of topic
        global $user_id;

        if (!$is_logged_in || !empty($sessionMessage)) {
            breakout('');
        }

        $db = db_connect($sessionMessage);

        if (!empty($sessionMessage) || $db === false) {
            breakout(' Database connection failed. ');
        }


        // Get all posts (as special array) for the user and topic.

        $special_post_array = TopicToPost::special_posts_array_for_user_and_topic($db, $sessionMessage, $user_id, $saved_int01);

        if (!$special_post_array) {
            breakout(' There are NO posts for YOU to delete here. ');
        }


        /**
         * Allow user to choose from amongst the posts which remain.
         */

        $html_title = 'Which post to delete?';

        require VIEWS . DIRSEP . 'authordeletesownpostchoosepost.php';
    }
}