<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TopicToPost;

class create_new_post_insert_point
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


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        /**
         * $g->saved_int01 should be the id of a topic This topic is the one the user is choosing
         * for her new post.
         *
         * Before we can present the form we need to have a special post array so we can list
         * all the posts in said topic.
         */

        $g->special_post_array = TopicToPost::special_get_posts_array_for_a_topic($g->saved_int01);

        if (!$g->special_post_array) {

            breakout(' Unable to get posts for the topic specified. ');

        }

        $g->html_title = 'Where will the new post go?';

        require VIEWS . DIRSEP . 'createnewpostinsertpoint.php';
    }
}