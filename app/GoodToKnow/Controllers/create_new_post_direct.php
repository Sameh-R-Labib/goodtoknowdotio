<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\topic_to_post;

class create_new_post_direct
{
    function page()
    {
        /**
         * create_new_post_direct enables the user to create a post without
         * needing to specify a topic. It assumes type_of_resource_requested
         * is topic. Then it uses (int)$g->topic_id instead of asking the
         * user to specify which topic he / she wants the new post to live in.
         *
         * create_new_post_direct is similar to create_new_post_processor
         */


        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();

        /**
         * Error out if we are not at the topic level.
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

            $_SESSION['saved_int02'] = FIRSTMIDDLESEQNUM;

            redirect_to("/ax1/create_new_post_title/page");

        }
    }
}