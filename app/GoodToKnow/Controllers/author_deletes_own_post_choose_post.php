<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TopicToPost;

class author_deletes_own_post_choose_post
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

        global $g;
        // $g->saved_int01 id of topic


        kick_out_loggedoutusers_or_if_there_is_error_msg();


        get_db();


        // Get all posts (as special array) for the user and topic.

        $g->special_post_array = TopicToPost::special_posts_array_for_user_and_topic($g->user_id, $g->saved_int01);

        if (!$g->special_post_array) {

            breakout(' There are NO posts for YOU to delete here. ');

        }


        /**
         * Allow user to choose from amongst the posts which remain.
         */

        $g->html_title = 'Which post to delete?';

        require VIEWS . DIRSEP . 'authordeletesownpostchoosepost.php';
    }
}