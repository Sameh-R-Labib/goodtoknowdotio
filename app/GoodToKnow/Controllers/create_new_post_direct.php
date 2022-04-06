<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\topic_to_post;

class create_new_post_direct
{
    function page()
    {
        /**
         * create_new_post_direct is similar to create_new_post_processor
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();

        /**
         * Error out if we are not at the topic level because.
         */

        if ($g->type_of_resource_requested != 'topic') {

            breakout(' Error: You must be at the topic level to run this feature. ');

        }


        $_SESSION['saved_int01'] = (int)$g->topic_id;


        /**
         * Redirect
         *
         * Where we redirect depends on whether or not there is one or more post in the chosen topic.
         */

        get_db();

        $posts = topic_to_post::get_posts_array_for_a_topic($g->topic_id);


        // The rest of this is the same as in create_new_post_processor

        if ($posts == false) $posts = [];

        $count = count($posts);

        if ($count > 0) {

            // We have some posts in our topic already

            redirect_to("/ax1/create_new_post_insert_point/page");

        } else {

            // There are NO posts in our topic

            $_SESSION['saved_int02'] = 10000;

            redirect_to("/ax1/create_new_post_title/page");

        }
    }
}