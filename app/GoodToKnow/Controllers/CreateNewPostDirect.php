<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TopicToPost;

class CreateNewPostDirect
{
    function page()
    {
        /**
         * CreateNewPostDirect is similar to CreateNewPostProcessor
         */


        global $g;


        kick_out_loggedoutusers();


        $_SESSION['saved_int01'] = $g->topic_id;


        /**
         * Redirect
         *
         * Where we redirect depends on whether or not there is one or more post in the chosen topic.
         */

        get_db();

        $posts = TopicToPost::get_posts_array_for_a_topic($g->topic_id);


        // The rest of this is the same as in CreateNewPostProcessor

        if ($posts == false) $posts = [];

        $count = count($posts);

        if ($count > 0) {

            // We have some posts in our topic already

            redirect_to("/ax1/CreateNewPostInsertPoint/page");

        } else {

            // There are NO posts in our topic

            $_SESSION['saved_int02'] = 10000;

            redirect_to("/ax1/CreateNewPostTitle/page");

        }
    }
}