<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\topic_to_post;

class create_new_post_processor
{
    function page(int $id = 0)
    {
        global $g;


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        $g->id = $id;


        // $_SESSION['saved_int01'] will acquire $g->id in get_and_save_the_topic_id.php
        require CONTROLLERINCLUDES . DIRSEP . 'get_and_save_the_topic_id.php';


        /**
         * Redirect
         *
         * Where we redirect depends on whether there is one or more post in the chosen topic.
         */

        get_db();

        $posts = topic_to_post::get_posts_array_for_a_topic($g->id);

        if (!$posts) $posts = [];

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