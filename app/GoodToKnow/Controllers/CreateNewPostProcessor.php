<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TopicToPost;

class CreateNewPostProcessor
{
    function page()
    {
        global $db;
        global $app_state;
        global $chosen_topic_id;


        // $_SESSION['saved_int01'] will acquire $chosen_topic_id in get_and_save_the_topic_id.php
        require CONTROLLERINCLUDES . DIRSEP . 'get_and_save_the_topic_id.php';


        /**
         * Redirect
         *
         * Where we redirect depends on whether or not there is one or more post in the chosen topic.
         */

        $db = get_db();

        $posts = TopicToPost::get_posts_array_for_a_topic($chosen_topic_id);

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