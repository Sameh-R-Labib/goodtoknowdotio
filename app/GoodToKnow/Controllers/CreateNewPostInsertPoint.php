<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TopicToPost;

class CreateNewPostInsertPoint
{
    function page()
    {
        /**
         * The goal is to present a form for specifying the location for
         * inserting the new post.
         *
         * The user answers two questions:
         *  1) Before or After?
         *  2) Which post?
         *
         * Note: Here it is assumed there is at least one post in the chosen topic.
         * Otherwise, this route will have had been skipped.
         */


        global $db;
        global $sessionMessage;
        global $html_title;
        global $saved_int01;
        global $special_post_array;


        kick_out_loggedoutusers();


        $db = get_db();


        /**
         * $saved_int01 should be the id of a topic This topic is the one the user is choosing
         * for her new post.
         *
         * Before we can present the form we need to have a special post array so we can list
         * all the posts in said topic.
         */

        $special_post_array = TopicToPost::special_get_posts_array_for_a_topic($db, $sessionMessage, $saved_int01);

        if (!$special_post_array) {

            breakout(' Unable to get posts for the topic specified. ');

        }

        $html_title = 'Where will the new post go?';

        require VIEWS . DIRSEP . 'createnewpostinsertpoint.php';
    }
}