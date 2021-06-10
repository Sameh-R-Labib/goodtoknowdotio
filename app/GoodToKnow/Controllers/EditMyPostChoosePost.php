<?php

namespace GoodToKnow\Controllers;

use GoodToKnow\Models\TopicToPost;

class EditMyPostChoosePost
{
    function page()
    {
        /**
         * The goal is to present a form with radio buttons for the user
         * to choose the post to edit. Since users can ONLY edit posts
         * which they have created they will ONLY see those.
         * We are ONLY presenting posts found in the topic which was
         * already selected. If we can't find any posts which meet the
         * criteria then we'll store a session message and redirect back home.
         */

        global $g;
        // $g->saved_int01 id of topic


        kick_out_loggedoutusers();


        $g->db = get_db();


        // Get all posts (as special array) for the user and topic.

        $g->special_post_array = TopicToPost::special_posts_array_for_user_and_topic($g->user_id, $g->saved_int01);

        if (!$g->special_post_array) {

            breakout(' There are NO posts for YOU to edit here. ');

        }


        /**
         * Allow user to choose from amongst
         * the posts which remain.
         */

        $g->html_title = 'Which post to edit?';

        require VIEWS . DIRSEP . 'editmypostchoosepost.php';
    }
}