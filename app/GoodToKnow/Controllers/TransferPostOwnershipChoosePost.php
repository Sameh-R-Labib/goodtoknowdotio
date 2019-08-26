<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TopicToPost;

class TransferPostOwnershipChoosePost
{
    function page()
    {
        /**
         * The goal is to present a form with radio buttons for admin to choose the post to transfer ownership of.
         * We are ONLY presenting posts found in the topic which was already selected. If we can't find any posts then
         * we'll store a session message and redirect back home.
         *
         * For each post we will show the complete name of the post along with the username of its author.
         */

        global $is_logged_in;
        global $sessionMessage;
        global $is_admin;
        global $saved_int01;        // id of topic

        if (!$is_logged_in || !$is_admin || !empty($sessionMessage)) {
            breakout('');
        }

        $db = get_db();

        $array_of_post_objects = TopicToPost::get_posts_array_for_a_topic($db, $sessionMessage, $saved_int01);

        if (!$array_of_post_objects) {
            breakout(' This topic does not contain any posts. ');
        }


        /**
         * Generate an array of author usernames. Each array element's value is a username which
         * is the username corresponding to the user_id of the corresponding element in the $array_of_post_objects.
         */

        $array_of_author_usernames = TopicToPost::get_author_usernames($db, $sessionMessage, $array_of_post_objects);

        if (!$array_of_author_usernames) {
            breakout(' Anomalous condition: Supposedly we have posts but do not have any authors. ');
        }

        $html_title = 'Which post to transfer ownership of?';

        require VIEWS . DIRSEP . 'transferpostownershipchoosepost.php';
    }
}